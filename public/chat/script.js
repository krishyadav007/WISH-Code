// ==========================
// Configuration and State
// ==========================
var converter = new showdown.Converter();

// API Endpoints
const API_BASE_URL = 'http://127.0.0.1:8000'; // Replace with your actual API base URL

const LIKERT_API_ENDPOINT = `${API_BASE_URL}/questions`;
const APTITUDE_API_ENDPOINT = `${API_BASE_URL}/questions`;
const MESSAGE_STORE_ENDPOINT = `${API_BASE_URL}/message_store`; // Endpoint to post messages
const CUSTOM_MESSAGE_API_ENDPOINT = `${API_BASE_URL}/ai/response/`; // Endpoint for other messages

// Application State
let currentSection = null; // 'likert' or 'aptitude' or 'custom'
let currentQuestionIndex = 0;
const responses = {
    likert: [],
    aptitude: []
};
let awaitingResponse = false; // Indicates if the bot is waiting for user input
let aptitudeScore = 0; // Tracks the user's score for the aptitude quiz

// Declare arrays to store fetched questions
const likertQuestions = [];
const aptitudeQuestions = [];

// ==========================
// DOM Elements
// ==========================
const chatMessages = document.getElementById('chat-messages');
const scrollToBottomBtn = document.getElementById('scroll-to-bottom');
const userInput = document.getElementById('user-input');
const sendBtn = document.getElementById('send-btn');

// ==========================
// Initialization
// ==========================

// Start the chat with a welcome message
addBotMessage("Hello! How can I assist you today?");
awaitingResponse = true;

// ==========================
// Event Listeners
// ==========================

// Send message on button click
sendBtn.addEventListener('click', sendMessage);

// Send message on 'Enter' key press
userInput.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
        sendBtn.click();
    }
});

// Handle scrolling in the chat container
chatMessages.addEventListener('scroll', handleScroll);

// Scroll to bottom when the button is clicked
scrollToBottomBtn.addEventListener('click', scrollToBottom);

// ==========================
// Core Functions
// ==========================

/**
 * Sends the user's message.
 */
function sendMessage() {
    const message = userInput.value.trim();
    if (message === '') return; // Do not send empty messages

    addUserMessage(message);
    postMessageToServer(message); // POST the message
    userInput.value = ''; // Clear the input field
}
/**
 * Adds a bot message to the chat with an image.
 * @param {string} message - The message to display.
 */
function addBotMessage(message) {
    const messageContainer = document.createElement('div');
    messageContainer.classList.add('flex', 'items-start', 'mb-2');

    const botImage = document.createElement('img');
    botImage.src = '/assets/img/bot.png'; // Replace with the actual bot image path
    botImage.alt = 'Bot';
    botImage.classList.add('w-8', 'h-8', 'rounded-full', 'mr-2');

    const messageDiv = document.createElement('div');
    messageDiv.classList.add(
        'p-2',
        'rounded-lg',
        'bg-gray-200',
        'self-start',
        'max-w-xl',
        'text-left'
    );
    messageDiv.innerHTML = message;

    messageContainer.appendChild(botImage);
    messageContainer.appendChild(messageDiv);
    chatMessages.appendChild(messageContainer);

    handleNewMessage();
}

/**
 * Adds a user message to the chat with an image.
 * @param {string} message - The message to display.
 */
function addUserMessage(message) {
    const messageContainer = document.createElement('div');
    messageContainer.classList.add('flex', 'items-start', 'justify-end', 'mb-2');

    const messageDiv = document.createElement('div');
    messageDiv.classList.add(
        'p-2',
        'rounded-lg',
        'bg-yellow-100',
        'self-end',
        'max-w-xl',
        'text-right'
    );
    messageDiv.textContent = message;

    const userImage = document.createElement('img');
    userImage.src = '/assets/img/user.png'; // Replace with the actual user image path
    userImage.alt = 'User';
    userImage.classList.add('w-8', 'h-8', 'rounded-full', 'ml-2');

    messageContainer.appendChild(messageDiv);
    messageContainer.appendChild(userImage);
    chatMessages.appendChild(messageContainer);

    handleNewMessage();
}


/**
 * Post message to the server and handle the response.
 * @param {string} message - The message to post.
 */
async function postMessageToServer(message) {
    try {
        const response = await fetch(MESSAGE_STORE_ENDPOINT, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ message }),
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        handleServerResponse(data.reply,message); // Handle the API's reply
    } catch (error) {
        console.error('Failed to send message to server:', error);
        addBotMessage("There was an error processing your message. Please try again.");
    }
}

/**
 * Handles the server's response to the user message.
 * Starts a Likert or aptitude quiz, or sends a custom message based on the response.
 * @param {string} reply - The server's reply (either 'likert', 'aptitude', or other).
 */
function handleServerResponse(intent,message) {
    if (intent.toLowerCase() === 'likert') {
        currentSection = 'likert';
        currentQuestionIndex = 0;
        addBotMessage("Starting the Likert survey.");
        fetchLikertQuestions()
            .then(() => {
                askNextQuestion();
            })
            .catch(error => {
                addBotMessage("Sorry, I couldn't load the Likert survey at this time.");
                console.error(error);
                resetChat();
            });
    } else if (intent.toLowerCase() === 'aptitude_test') {
        currentSection = 'aptitude';
        currentQuestionIndex = 0;
        aptitudeScore = 0; // Reset the score for the new quiz
        addBotMessage("Starting the Aptitude quiz.");
        fetchAptitudeQuestions()
            .then(() => {
                askNextQuestion();
            })
            .catch(error => {
                addBotMessage("Sorry, I couldn't load the Aptitude quiz at this time.");
                console.error(error);
                resetChat();
            });
    } else {
        // Handle other messages and post them to another API
        postCustomMessageToServer(intent,message);
    }
}

/**
 * Fetches Likert survey questions from the API.
 * @returns {Promise<void>}
 */
async function fetchLikertQuestions() {
    try {
        const response = await fetch(LIKERT_API_ENDPOINT);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const likertData = await response.json();
        likertQuestions.length = 0; // Clear existing questions
        likertData.forEach(q => likertQuestions.push(q));
    } catch (error) {
        console.error('Failed to fetch Likert questions:', error);
        throw error;
    }
}

/**
 * Fetches Aptitude quiz questions from the API.
 * @returns {Promise<void>}
 */
async function fetchAptitudeQuestions() {
    try {
        const response = await fetch(APTITUDE_API_ENDPOINT);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const aptitudeData = await response.json();
        aptitudeQuestions.length = 0; // Clear existing questions
        aptitudeData.forEach(q => aptitudeQuestions.push(q));
    } catch (error) {
        console.error('Failed to fetch Aptitude questions:', error);
        throw error;
    }
}

/**
 * Asks the next question in the current section.
 */
function askNextQuestion() {
    if (currentSection === 'likert') {
        if (currentQuestionIndex < likertQuestions.length) {
            const q = likertQuestions[currentQuestionIndex];
            addBotMessage(q.question);
            displayLikertButtons(q.scale, q.id);
            awaitingResponse = true;
        } else {
            addBotMessage("Thank you for completing the Likert survey!");
            resetChat();
        }
    } else if (currentSection === 'aptitude') {
        if (currentQuestionIndex < aptitudeQuestions.length) {
            const q = aptitudeQuestions[currentQuestionIndex];
            addBotMessage(q.question);
            displayAptitudeButtons(q.options, q.correct_answer, q.id);
            awaitingResponse = true;
        } else {
            addBotMessage(`Great job! You've completed the Aptitude quiz. Your score is ${aptitudeScore}/${aptitudeQuestions.length}.`);
            resetChat();
        }
    }
}

/**
 * Displays Likert scale options as buttons.
 * @param {Array<string>} scale - The Likert scale options.
 * @param {number} questionId - The ID of the question.
 */
function displayLikertButtons(scale, questionId) {
    const likertDiv = document.createElement('div');
    likertDiv.classList.add('flex', 'space-x-4', 'mt-2');

    scale.forEach(option => {
        const button = document.createElement('button');
        button.textContent = option;
        button.classList.add(
            'bg-gray-200',
            'text-gray-800',
            'py-2',
            'px-4',
            'rounded-lg',
            'hover:bg-gray-300',
            'focus:outline-none',
            'focus:ring'
        );
        button.addEventListener('click', () => handleLikertAnswer(option, questionId));
        likertDiv.appendChild(button);
    });

    chatMessages.appendChild(likertDiv);
    handleNewMessage();
}

/**
 * Handles the user's Likert answer submission.
 * @param {string} answer - The selected answer.
 * @param {number} questionId - The ID of the question.
 */
function handleLikertAnswer(answer, questionId) {
    responses.likert.push({ questionId, answer });
    currentQuestionIndex++;
    askNextQuestion();
}

/**
 * Displays aptitude options as buttons.
 * @param {Array<string>} options - The multiple choice options.
 * @param {string} correctAnswer - The correct answer.
 * @param {number} questionId - The ID of the question.
 */
function displayAptitudeButtons(options, correctAnswer, questionId) {
    const aptitudeDiv = document.createElement('div');
    aptitudeDiv.classList.add('flex', 'space-x-4', 'mt-2');

    options.forEach(option => {
        const button = document.createElement('button');
        button.textContent = option;
        button.classList.add(
            'bg-gray-200',
            'text-gray-800',
            'py-2',
            'px-4',
            'rounded-lg',
            'hover:bg-gray-300',
            'focus:outline-none',
            'focus:ring'
        );
        button.addEventListener('click', () => handleAptitudeAnswer(option, correctAnswer, questionId));
        aptitudeDiv.appendChild(button);
    });

    chatMessages.appendChild(aptitudeDiv);
    handleNewMessage();
}

/**
 * Handles the user's Aptitude answer submission.
 * @param {string} answer - The selected answer.
 * @param {string} correctAnswer - The correct answer for the question.
 * @param {number} questionId - The ID of the question.
 */
function handleAptitudeAnswer(answer, correctAnswer, questionId) {
    responses.aptitude.push({ questionId, answer });

    // Check if the answer is correct and update the score
    if (answer === correctAnswer) {
        aptitudeScore++;
    }

    currentQuestionIndex++;
    askNextQuestion();
}

/**
 * Posts custom messages to another server endpoint.
 * @param {string} intent - The message to post.
 */
async function postCustomMessageToServer(intent,postCustomMessageToServer) {
    try {
        const response = await fetch(CUSTOM_MESSAGE_API_ENDPOINT + intent + "/" + postCustomMessageToServer, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ intent }),
        });
    
        if (!response.ok) {
            throw new Error(`Server error: ${response.status}`);
        }
    
        const responseText = await response.text(); // or response.json() if the response is JSON
        console.log('Server response:', responseText);
        addBotMessage(converter.makeHtml(responseText));
    
    } catch (error) {
        addBotMessage('Response failed');
        // console.error('Failed to send custom message to server:', error);
    }
}

// ==========================
// Utility Functions
// ==========================

/**
 * Handles scrolling events in the chat container.
 */
function handleScroll() {
    const isAtBottom = chatMessages.scrollHeight - chatMessages.scrollTop === chatMessages.clientHeight;
    scrollToBottomBtn.style.display = isAtBottom ? 'none' : 'block';
}

/**
 * Scrolls the chat container to the bottom.
 */
function scrollToBottom() {
    chatMessages.scrollTop = chatMessages.scrollHeight;
    scrollToBottomBtn.style.display = 'none';
}

/**
 * Handles new messages being added to the chat.
 */
function handleNewMessage() {
    scrollToBottom();
    awaitingResponse = false;
}

/**
 * Resets the chat after a survey or quiz.
 */
function resetChat() {
    currentSection = null;
    currentQuestionIndex = 0;
    awaitingResponse = false;
    addBotMessage("Feel free to ask anything else or start a new survey/quiz.");
}

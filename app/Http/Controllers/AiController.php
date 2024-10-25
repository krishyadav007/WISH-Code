<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Intervention;


class AiController extends Controller
{
    // public function __construct()
    // {
    //     // $this->middleware('auth');
    // }
    
    // Display a listing of the resource
    public function intent($msg)
    {
        $curl = curl_init();

// Define the API endpoint with the version query parameter
$url = "https://eu-de.ml.cloud.ibm.com/ml/v1/text/generation?version=2023-05-29";

// Prepare the JSON payload
$data = [
    "input" => "Act as a helpful chatbot classifier. Your organization has created several project categories described below. 

# mentorship
Involves discussions around seeking or offering mentorship in STEM, providing guidance, and sharing knowledge with peers or juniors.

# women_in_stem
Focuses on contributions, challenges, and stories of women in STEM fields, highlighting their achievements and gender-related issues.

# current_STEM_news
Covers recent advancements, innovations, and news in science, technology, engineering, and mathematics.

# likert
Relates to questions or statements structured for Likert-scale surveys, often used to gauge opinions, preferences, or attitudes.

# aptitude_test
Concerns questions about preparing for and understanding the types of aptitude tests typically used for career or educational purposes.

# casual_talk
Encompasses general, informal conversations not directly tied to the other categories, often personal or light-hearted in nature.

# motivational_quotes
Requests for quotes or sayings that provide inspiration and encouragement, often to uplift and motivate individuals.

# connect_consultant
Involves queries or conversations about connecting with professionals or consultants for advice, mentorship, or career guidance.

# career_help
Focuses on seeking guidance, resources, or advice for career planning, progression, and overcoming professional challenges.

# problem
Addresses challenges or issues, often related to gender bias or other obstacles encountered in the STEM environment.

The following paragraph is a message. The message must be classified in one of the categories described above. Read the following description and determine which category the project is about. Make sure to use exactly one of the names of the categories listed above.  Name of the category:

Input: I am looking for some mentorship opportunities
Output: mentorship

Input: Can you suggest some STEM events for me?
Output: mentorship

Input: mentorship
Output: mentorship

Input: Significant contributions of women in STEM fields
Output: women_in_stem

Input: Challenges and triumphs of women in STEM
Output: women_in_stem

Input: Inspiring stories of women breaking barriers in scientific research
Output: women_in_stem

Input: What are the latest developments in technology?
Output: current_STEM_news

Input: Innovative solutions for sustainable energy and environmental conservation
Output: current_STEM_news

Input: Trends in data analysis and machine learning algorithms
Output: current_STEM_news

Input: I want to do a survey
Output: likert

Input: My interest level
Output: likert

Input: I want to take a survey
Output: likert

Input: I want to solve the test
Output: aptitude_test

Input: I want to take the test
Output: aptitude_test

Input: I want to take the aptitude test
Output: aptitude_test

Input: Do you have any recommendations for a good restaurant?
Output: casual_talk

Input: How do I change the oil in my car?
Output: casual_talk

Input: How do I make a grilled cheese sandwich?
Output: casual_talk

Input: I am feeling down. Can you share an uplifting quote?
Output: motivational_quotes

Input: Feeling low and in need of motivation. Any words of encouragement?
Output: motivational_quotes

Input: Feeling down and lacking motivation. Could use some motivational quotes
Output: motivational_quotes

Input: I want to meet some people
Output: connect_consultant

Input: You do not understand me
Output: connect_consultant

Input: I need guidance on networking
Output: connect_consultant

Input: Are there any online courses or workshops that can help me navigate my career options?
Output: career_help

Input: I'm seeking advice on how to make a career change successfully
Output: career_help

Input: Can you recommend any books or resources for exploring different career paths?
Output: career_help

Input: I feel like I have to work twice as hard to be taken seriously
Output: problem

Input: I've been told that I'm 'not like other girls' because I'm interested in STEM
Output: problem

Input: I've been questioned about my abilities or qualifications more than my male peers
Output: problem

Input: Hello!
Output: greeting

Input: How are you?
Output: greeting

Input: What's up?
Output: greeting

Input: ".$msg."
Output:",
    "parameters" => [
        "decoding_method" => "greedy",
        "max_new_tokens" => 200,
        "min_new_tokens" => 0,
        "stop_sequences" => [],
        "repetition_penalty" => 1
    ],
    "model_id" => "ibm/granite-13b-instruct-v2",
    "project_id" => "9c722769-7f32-4861-8f1b-d83465ca0f0d",
    "moderations" => [
        "hap" => [
            "input" => [
                "enabled" => true,
                "threshold" => 0.5,
                "mask" => [
                    "remove_entity_value" => true
                ]
            ],
            "output" => [
                "enabled" => true,
                "threshold" => 0.5,
                "mask" => [
                    "remove_entity_value" => true
                ]
            ]
        ]
    ]
];

    // Encode the data array to JSON
    $jsonData = json_encode($data);

    // Set the Authorization token
    $bearerToken = env('accessToken');

    // Set the cURL options
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true, // Return the response as a string
        CURLOPT_POST => true, // Use POST method
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "Accept: application/json",
            "Authorization: Bearer $bearerToken"
        ],
        CURLOPT_POSTFIELDS => $jsonData, // Attach the JSON payload
        CURLOPT_SSL_VERIFYPEER => true, // Verify SSL certificate
        CURLOPT_SSL_VERIFYHOST => 2, // Check the existence of a common name and verify that it matches the hostname provided
        CURLOPT_TIMEOUT => 30, // Timeout after 30 seconds
    ]);

    // Execute the cURL request
    $response = curl_exec($curl);

    // Check for errors
    if (curl_errno($curl)) {
        // Output the error
        return 'cURL Error: ' . curl_error($curl);
    } else {
        // Decode and process the response if needed
        $decodedResponse = json_decode($response, true);
        
        // For demonstration, we'll just output the response
        // echo json_encode($decodedResponse, JSON_PRETTY_PRINT);
    }

    // Close the cURL session
    curl_close($curl);
        return trim($decodedResponse["results"][0]["generated_text"]);
        // return json_encode($decodedResponse, JSON_PRETTY_PRINT);
    }

        // Display a listing of the resource
public function respond($message) {

$url = "https://eu-de.ml.cloud.ibm.com/ml/v1/text/generation?version=2023-05-29";
$accessToken = env('accessToken'); // Replace with your actual access token

$data = json_encode([
    "input" => "You are an AI mentor focused on empowering and supporting women who are navigating the challenges of pursuing careers in STEM (Science, Technology, Engineering, and Mathematics). Following is the message sent by the user, respond in a polite manner. Respond only to the message send, do not create other inputs and responses

Be empathetic, understanding that they may be experiencing challenges, self-doubt, or feelings of uncertainty for the first time.
Remind them that it’s completely normal to feel this way, and their struggles are valid.
Offer encouragement by affirming that, despite these challenges, they have the potential to inspire others with their courage and perseverance.
Share stories of women in STEM who have faced similar obstacles and gone on to make incredible contributions.
Provide practical strategies for building confidence, managing self-doubt, and finding support systems like mentorship or networking groups.
Highlight that their unique experiences and perspectives are essential to the growth of the STEM field.
Encourage them to keep moving forward, knowing that by overcoming these obstacles, they are not only achieving their own goals but also becoming role models for future generations.
Show compassion and understanding, while empowering them to see their journey as one that will have a lasting impact on themselves and others.

Following is the message sent by the user, respond in a polite manner. Respond only to the message send, do not create other inputs and responses pursuing careers in STEM (Science, Technology, Engineering, and Mathematics). You should:\n\nBe empathetic, understanding that they may be experiencing challenges, self-doubt, or feelings of uncertainty for the first time.\nRemind them that it’s completely normal to feel this way, and their struggles are valid.\nOffer encouragement by affirming that, despite these challenges, they have the potential to inspire others with their courage and perseverance.\nShare stories of women in STEM who have faced similar obstacles and gone on to make incredible contributions.\nProvide practical strategies for building confidence, managing self-doubt, and finding support systems like mentorship or networking groups.\nHighlight that their unique experiences and perspectives are essential to the growth of the STEM field.\nEncourage them to keep moving forward, knowing that by overcoming these obstacles, they are not only achieving their own goals but also becoming role models for future generations.\nShow compassion and understanding, while empowering them to see their journey as one that will have a lasting impact on themselves and others.\n\nInput: I am feeling down, stem is not my cup of tea\nOutput: I'\''m really sorry you'\''re feeling down right now. I want you to know that you absolutely belong in STEM, and your unique perspective is invaluable. It'\''s natural to feel unsure at times, especially in fields that can feel challenging or where representation may be uneven. But your curiosity, drive, and intelligence are exactly what STEM needs. Every great scientist, engineer, or innovator has faced moments of doubt, but pushing through is what leads to breakthroughs.\n\nYou don'\''t have to have all the answers right now — growth comes from taking small steps and learning along the way. Remember, you’re not alone, and there are so many people cheering for your success. You have the strength to overcome this, and the world needs your voice in STEM. Keep going — you’ve got this!\n\nInput: Please help me in my stem journey \nOutput: You’re breaking barriers: By pursuing STEM, you'\''re contributing to the growing number of women who are reshaping this field. That’s powerful. Every challenge you overcome helps pave the way for future generations of women and girls to succeed, too.\n\nInput: ".$message."\nOutput:",
    "parameters" => [
        "decoding_method" => "greedy",
        "max_new_tokens" => 200,
        "min_new_tokens" => 0,
        "stop_sequences" => [],
        "repetition_penalty" => 1
    ],
    "model_id" => "ibm/granite-13b-chat-v2",
    "project_id" => "9c722769-7f32-4861-8f1b-d83465ca0f0d",
    "moderations" => [
        "hap" => [
            "input" => [
                "enabled" => true,
                "threshold" => 0.5,
                "mask" => [
                    "remove_entity_value" => true
                ]
            ],
            "output" => [
                "enabled" => true,
                "threshold" => 0.5,
                "mask" => [
                    "remove_entity_value" => true
                ]
            ]
        ]
    ]
]);

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $data,
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'Accept: application/json',
        'Authorization: Bearer ' . $accessToken
    ],
]);

$response = curl_exec($curl);
$decodedResponse = json_decode($response, true);
curl_close($curl);

return explode("Input:",$decodedResponse["results"][0]["generated_text"])[0];
}

public function ResponseFeed($type,$message)
        {
            $freeform_gai = ["women_in_stem","casual_talk","motivational_quotes","career_help","problem","greeting"];
            $checked_gai = ["connect_consultant", "current_STEM_news", "mentorship"];
            
            if (in_array($type,$checked_gai)) {
                $InterventionController = new InterventionController;
                return $InterventionController->getIntervention($type);
            }
            else if(in_array($type,$freeform_gai)) {
                return $this->respond($message);
            }
            else {
                return "Something went wrong";
            }
        }
    }
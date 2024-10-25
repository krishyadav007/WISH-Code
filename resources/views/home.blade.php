@extends('layouts.app')
@section('heady')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/showdown/2.1.0/showdown.min.js"></script>
    <script defer src="/chat/script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
@endsection('heady')

@section('content')
<section class="wrapper bg-light py-14 py-md-16">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="flex flex-col h-screen max-w-3xl mx-auto border rounded-lg shadow-md bg-white">
                    <!-- Chat Messages Area -->
                    <div id="chat-messages" class="flex-1 p-4 overflow-y-auto bg-gray-50">
                        <!-- Chat messages will appear here dynamically -->
                    </div>

                    <!-- Scroll to Bottom Button -->
                    <button id="scroll-to-bottom"
                        class="hidden fixed right-4 bottom-20 bg-blue-500 text-white py-2 px-4 rounded-full shadow-md">
                        Scroll to Bottom
                    </button>

                    <!-- User Input Area -->
                    <div class="flex p-4 border-t border-gray-200">
                        <input id="user-input" type="text" placeholder="Type a message..."
                            class="flex-grow p-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                        <button id="send-btn"
                            class="ml-4 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring">
                            Send
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<!-- </body> -->
<!-- </html> -->

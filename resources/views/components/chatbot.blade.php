<!-- AI Chatbot Component -->
<style>
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    @keyframes bounce {
        0%, 20%, 53%, 80%, 100% { transform: translate3d(0,0,0); }
        40%, 43% { transform: translate3d(0,-8px,0); }
        70% { transform: translate3d(0,-4px,0); }
    }

    .chatbot-typing {
        animation: bounce 1.4s ease-in-out infinite;
    }

            /* Ensure chatbot is always visible */
    #chatbot-container {
        position: fixed !important;
        bottom: 20px !important;
        right: 20px !important;
        z-index: 9999 !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    #chatbot-toggle {
        position: relative !important;
        z-index: 10000 !important;
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3) !important;
        border: 3px solid #ffffff !important;
    }

    /* Make it very visible for testing */
    #chatbot-toggle:hover {
        transform: scale(1.1) !important;
        box-shadow: 0 15px 40px rgba(0,0,0,0.4) !important;
    }

        /* Responsive chat window positioning */
    #chatbot-window {
        position: absolute !important;
        bottom: 24px !important;
        right: 0 !important;
        width: 320px !important;
        max-width: calc(100vw - 40px) !important;
        height: 500px !important;
        max-height: calc(100vh - 100px) !important;
        overflow: hidden !important;
    }

    /* Ensure chat window stays within viewport on small screens */
    @media (max-width: 400px) {
        #chatbot-window {
            right: -20px !important;
            width: calc(100vw - 40px) !important;
            height: calc(100vh - 80px) !important;
        }
    }

    @media (max-width: 768px) {
        #chatbot-container {
            bottom: 10px !important;
            right: 10px !important;
        }

        #chatbot-window {
            bottom: 20px !important;
            right: 0 !important;
            width: 300px !important;
            height: 450px !important;
        }
    }

    /* Ensure chat messages are scrollable */
    #chatbot-messages {
        overflow-y: auto !important;
        scrollbar-width: thin !important;
        scrollbar-color: #64748b #475569 !important;
        max-height: 320px !important;
        min-height: 320px !important;
    }

    #chatbot-messages::-webkit-scrollbar {
        width: 6px !important;
    }

    #chatbot-messages::-webkit-scrollbar-track {
        background: #475569 !important;
    }

    #chatbot-messages::-webkit-scrollbar-thumb {
        background: #64748b !important;
        border-radius: 3px !important;
    }

    #chatbot-messages::-webkit-scrollbar-thumb:hover {
        background: #94a3b8 !important;
    }
</style>

<div id="chatbot-container" class="fixed bottom-4 right-4 z-50">
    <!-- Chat Toggle Button -->
    <button id="chatbot-toggle" class="w-20 h-20 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full shadow-2xl hover:shadow-3xl transform hover:scale-110 transition-all duration-300 flex items-center justify-center border-4 border-white">
        <i id="chatbot-icon" class="fas fa-comments text-white text-3xl"></i>
        <i id="chatbot-close-icon" class="fas fa-times text-white text-3xl hidden"></i>

        <!-- Notification Badge -->
        <div id="chatbot-notification" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 rounded-full flex items-center justify-center hidden">
            <span class="text-white text-xs font-bold">!</span>
        </div>
    </button>

    <!-- Debug Info (remove in production) -->
    <div class="absolute bottom-24 right-0 bg-black bg-opacity-75 text-white text-xs p-2 rounded hidden" id="chatbot-debug">
        Chatbot Loaded Successfully
    </div>

    <!-- Chat Window -->
    <div id="chatbot-window" class="hidden absolute bottom-24 right-0 w-80 h-[500px] bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl shadow-2xl border border-slate-600 overflow-hidden flex flex-col">
        <!-- Chat Header -->
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-4 py-3 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-robot text-white"></i>
                </div>
                <div>
                    <h3 class="text-white font-semibold">BarberFinder AI</h3>
                    <p class="text-indigo-100 text-xs">Your personal barber assistant</p>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <button id="chatbot-clear" class="text-white hover:text-indigo-200 transition-colors p-1 rounded hover:bg-white hover:bg-opacity-20" title="Clear Chat">
                    <i class="fas fa-trash-alt text-sm"></i>
                </button>
                <button id="chatbot-minimize" class="text-white hover:text-indigo-200 transition-colors p-1 rounded hover:bg-white hover:bg-opacity-20" title="Minimize">
                    <i class="fas fa-minus text-sm"></i>
                </button>
            </div>
        </div>

        <!-- Chat Messages -->
        <div id="chatbot-messages" class="flex-1 overflow-y-auto p-4 space-y-4 bg-slate-700">
            <!-- Welcome Message -->
            <div class="flex items-start space-x-3">
                <div class="w-8 h-8 bg-indigo-500 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-robot text-white text-sm"></i>
                </div>
                <div class="bg-slate-600 rounded-lg px-3 py-2 max-w-xs border border-slate-500 shadow-lg">
                    <p class="text-slate-100 text-sm">Hi! I'm your AI barber assistant. How can I help you today? I can help with:</p>
                    <ul class="text-slate-300 text-xs mt-2 space-y-1">
                        <li>• Finding barbers near you</li>
                        <li>• Booking appointments</li>
                        <li>• Service information</li>
                        <li>• General questions</li>
                    </ul>

                                    <!-- Quick Action Buttons -->
                <div class="mt-3 space-y-2">
                    <button class="quick-action-btn bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white text-xs px-3 py-1 rounded-lg transition duration-200 shadow-md border border-indigo-400" data-action="find barbers">
                        🔍 Find Barbers
                    </button>
                    <button class="quick-action-btn bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white text-xs px-3 py-1 rounded-lg transition duration-200 shadow-md border border-green-400" data-action="book appointment">
                        📅 Book Appointment
                    </button>
                    <button class="quick-action-btn bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white text-xs px-3 py-1 rounded-lg transition duration-200 shadow-md border border-purple-400" data-action="services and pricing">
                        ✂️ Services & Pricing
                    </button>
                </div>
                </div>
            </div>
        </div>

        <!-- Chat Input -->
        <div class="p-4 border-t border-slate-600 bg-slate-800 flex-shrink-0">
            <div class="flex space-x-2">
                <input type="text" id="chatbot-input" placeholder="Type your message..." class="flex-1 bg-slate-600 text-white placeholder-slate-300 border border-slate-500 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400">
                <button id="chatbot-send" class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white px-4 py-2 rounded-lg transition duration-300 flex items-center shadow-lg border border-indigo-400 hover:border-purple-400">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Chatbot: DOM loaded, initializing...');

    const chatbotContainer = document.getElementById('chatbot-container');
    const chatbotToggle = document.getElementById('chatbot-toggle');
    const chatbotWindow = document.getElementById('chatbot-window');
    const chatbotIcon = document.getElementById('chatbot-icon');
    const chatbotCloseIcon = document.getElementById('chatbot-close-icon');
    const chatbotMinimize = document.getElementById('chatbot-minimize');
    const chatbotClear = document.getElementById('chatbot-clear');
    const chatbotMessages = document.getElementById('chatbot-messages');
    const chatbotInput = document.getElementById('chatbot-input');
    const chatbotSend = document.getElementById('chatbot-send');
    const chatbotDebug = document.getElementById('chatbot-debug');

    // Debug: Check if elements exist
    if (!chatbotContainer) console.error('Chatbot: Container not found');
    if (!chatbotToggle) console.error('Chatbot: Toggle button not found');
    if (!chatbotWindow) console.error('Chatbot: Window not found');

    // Show debug info briefly
    if (chatbotDebug) {
        chatbotDebug.classList.remove('hidden');
        setTimeout(() => {
            chatbotDebug.classList.add('hidden');
        }, 3000);
    }

    console.log('Chatbot: Elements found, continuing initialization...');

    // Test the chatbot functionality
    setTimeout(() => {
        console.log('Chatbot: Testing functionality...');
        if (chatbotInput && chatbotSend) {
            console.log('Chatbot: Input and send button found');
        } else {
            console.error('Chatbot: Missing input or send button');
        }
    }, 1000);

    let isOpen = false;
    let chatHistory = JSON.parse(localStorage.getItem('chatbotHistory') || '[]');

    // Load chat history if exists
    if (chatHistory.length > 0) {
        chatHistory.forEach(msg => {
            addMessage(msg.text, msg.sender, false);
        });
    }

    // Toggle chat window
    chatbotToggle.addEventListener('click', function() {
        if (isOpen) {
            closeChat();
        } else {
            openChat();
        }
    });

    // Minimize chat
    chatbotMinimize.addEventListener('click', function() {
        closeChat();
    });

    // Clear chat history
    chatbotClear.addEventListener('click', function() {
        if (confirm('Are you sure you want to clear the chat history?')) {
            clearChatHistory();
        }
    });

    // Send message on Enter key
    chatbotInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });

    // Send message on button click
    chatbotSend.addEventListener('click', sendMessage);

    // Handle window resize
    window.addEventListener('resize', function() {
        if (isOpen) {
            ensureChatWindowPosition();
        }
    });

    // Add event delegation for quick action buttons
    chatbotMessages.addEventListener('click', function(e) {
        if (e.target.classList.contains('quick-action-btn')) {
            const action = e.target.getAttribute('data-action');
            if (action) {
                sendQuickAction(action);
            }
        }
    });

        function openChat() {
        chatbotWindow.classList.remove('hidden');
        chatbotIcon.classList.add('hidden');
        chatbotCloseIcon.classList.remove('hidden');
        chatbotInput.focus();
        isOpen = true;

        // Ensure proper positioning
        ensureChatWindowPosition();

        // Add entrance animation
        chatbotWindow.style.transform = 'scale(0.8) translateY(20px)';
        chatbotWindow.style.opacity = '0';

        setTimeout(() => {
            chatbotWindow.style.transition = 'all 0.3s ease';
            chatbotWindow.style.transform = 'scale(1) translateY(0)';
            chatbotWindow.style.opacity = '1';
        }, 10);
    }

        function ensureChatWindowPosition() {
        // Keep the chat window in a fixed position relative to the toggle button
        // This prevents it from going off-screen after messages
        chatbotWindow.style.position = 'absolute';
        chatbotWindow.style.bottom = '24px';
        chatbotWindow.style.right = '0px';
        
        const viewportWidth = window.innerWidth;
        const viewportHeight = window.innerHeight;

        // Ensure it doesn't go off-screen on very small devices
        if (viewportWidth < 400) {
            chatbotWindow.style.width = (viewportWidth - 40) + 'px';
            chatbotWindow.style.right = '-20px';
        } else if (viewportWidth < 768) {
            chatbotWindow.style.width = '300px';
        } else {
            chatbotWindow.style.width = '320px';
        }

        // Adjust height for small screens
        if (viewportHeight < 600) {
            chatbotWindow.style.height = (viewportHeight - 100) + 'px';
        } else {
            chatbotWindow.style.height = '500px';
        }
    }

    function closeChat() {
        chatbotWindow.classList.add('hidden');
        chatbotIcon.classList.remove('hidden');
        chatbotCloseIcon.classList.add('hidden');
        isOpen = false;

        // Reset transform for next open
        chatbotWindow.style.transform = 'scale(0.8) translateY(20px)';
        chatbotWindow.style.opacity = '0';
    }

    // Add notification when chat is closed and new message arrives
        function showNotification() {
        if (!isOpen) {
            chatbotToggle.style.animation = 'pulse 1s infinite';
            chatbotToggle.style.boxShadow = '0 0 20px rgba(147, 51, 234, 0.8)';

            // Remove animation after 3 seconds
            setTimeout(() => {
                chatbotToggle.style.animation = '';
                chatbotToggle.style.boxShadow = '';
            }, 3000);
        }
    }

    function clearChatHistory() {
        // Clear messages from display
        chatbotMessages.innerHTML = '';

        // Clear from localStorage
        chatHistory = [];
        localStorage.removeItem('chatbotHistory');

        // Add welcome message back
        addWelcomeMessage();
    }

    function addWelcomeMessage() {
        const welcomeDiv = document.createElement('div');
        welcomeDiv.className = 'flex items-start space-x-3';
        welcomeDiv.innerHTML = `
            <div class="w-8 h-8 bg-indigo-500 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-robot text-white text-sm"></i>
            </div>
            <div class="bg-slate-600 rounded-lg px-3 py-2 max-w-xs border border-slate-500 shadow-lg">
                <p class="text-slate-100 text-sm">Hi! I'm your AI barber assistant. How can I help you today? I can help with:</p>
                <ul class="text-slate-300 text-xs mt-2 space-y-1">
                    <li>• Finding barbers near you</li>
                    <li>• Booking appointments</li>
                    <li>• Service information</li>
                    <li>• General questions</li>
                </ul>

                <!-- Quick Action Buttons -->
                <div class="mt-3 space-y-2">
                    <button class="quick-action-btn bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white text-xs px-3 py-1 rounded-lg transition duration-200 shadow-md border border-indigo-400" data-action="find barbers">
                        🔍 Find Barbers
                    </button>
                    <button class="quick-action-btn bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white text-xs px-3 py-1 rounded-lg transition duration-200 shadow-md border border-green-400" data-action="book appointment">
                        📅 Book Appointment
                    </button>
                    <button class="quick-action-btn bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white text-xs px-3 py-1 rounded-lg transition duration-200 shadow-md border border-purple-400" data-action="services and pricing">
                        ✂️ Services & Pricing
                    </button>
                </div>
            </div>
        `;
        chatbotMessages.appendChild(welcomeDiv);
    }

    function sendMessage() {
        const message = chatbotInput.value.trim();
        if (!message) return;

        console.log('Chatbot: Sending message:', message);

        // Add user message
        addMessage(message, 'user');
        chatbotInput.value = '';

        // Show typing indicator
        showTypingIndicator();

        // Get AI response
        generateAIResponse(message).then(response => {
            console.log('Chatbot: AI response received:', response);
            hideTypingIndicator();
            addMessage(response, 'ai');
        }).catch(error => {
            console.error('Chatbot: Error getting AI response:', error);
            hideTypingIndicator();
            addMessage("I'm sorry, I'm having trouble connecting right now. Please try again in a moment.", 'ai');
        });
    }

            function addMessage(text, sender, saveToHistory = true) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'flex items-start space-x-3';

        if (sender === 'user') {
            messageDiv.innerHTML = `
                <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-user text-white text-sm"></i>
                </div>
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg px-3 py-2 max-w-xs ml-auto shadow-lg border border-indigo-400">
                    <p class="text-white text-sm font-medium">${text}</p>
                </div>
            `;
        } else {
            // Format AI response with line breaks and styling
            const formattedText = text.replace(/\n/g, '<br>');
            messageDiv.innerHTML = `
                <div class="w-8 h-8 bg-indigo-500 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-robot text-white text-sm"></i>
                </div>
                <div class="bg-slate-600 rounded-lg px-3 py-2 max-w-xs border border-slate-500 shadow-lg">
                    <div class="text-slate-100 text-sm leading-relaxed">${formattedText}</div>
                </div>
            `;
        }

        chatbotMessages.appendChild(messageDiv);
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;

        // Save to chat history
        if (saveToHistory) {
            chatHistory.push({ text, sender, timestamp: new Date().toISOString() });

            // Keep only last 50 messages
            if (chatHistory.length > 50) {
                chatHistory = chatHistory.slice(-50);
            }

            localStorage.setItem('chatbotHistory', JSON.stringify(chatHistory));
        }

        // Show notification if chat is closed
        if (sender === 'ai' && !isOpen) {
            showNotification();
        }
    }

    function sendQuickAction(action) {
        console.log('Chatbot: Quick action clicked:', action);
        chatbotInput.value = action;
        sendMessage();
    }

    function showTypingIndicator() {
        const typingDiv = document.createElement('div');
        typingDiv.id = 'typing-indicator';
        typingDiv.className = 'flex items-start space-x-3';
        typingDiv.innerHTML = `
            <div class="w-8 h-8 bg-indigo-500 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-robot text-white text-sm"></i>
            </div>
            <div class="bg-slate-600 rounded-lg px-3 py-2 border border-slate-500 shadow-lg">
                <div class="flex space-x-1">
                    <div class="w-2 h-2 bg-indigo-400 rounded-full animate-bounce"></div>
                    <div class="w-2 h-2 bg-indigo-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                    <div class="w-2 h-2 bg-indigo-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                </div>
            </div>
        `;
        chatbotMessages.appendChild(typingDiv);
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    }

    function hideTypingIndicator() {
        const typingIndicator = document.getElementById('typing-indicator');
        if (typingIndicator) {
            typingIndicator.remove();
        }
    }

        async function generateAIResponse(userMessage) {
        try {
            console.log('Chatbot: Attempting to fetch AI response for:', userMessage);

            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) {
                console.error('Chatbot: CSRF token not found');
                throw new Error('CSRF token not found');
            }

            const response = await fetch('/chatbot/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken.content,
                },
                body: JSON.stringify({ message: userMessage })
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            console.log('Chatbot: Backend response:', data);
            return data.response;
        } catch (error) {
            console.error('Chatbot: Backend API error:', error);
            // Fallback to local responses
            return generateLocalResponse(userMessage);
        }
    }

    function generateLocalResponse(userMessage) {
        console.log('Chatbot: Using local fallback response for:', userMessage);
        const message = userMessage.toLowerCase();

        // Barber finding responses
        if (message.includes('find') || message.includes('barber') || message.includes('search')) {
            return "I can help you find barbers! Use our search feature to find barbers near you. You can filter by location, services, ratings, and price range. Would you like me to show you how to use the search?";
        }

        // Appointment responses
        if (message.includes('book') || message.includes('appointment') || message.includes('schedule')) {
            return "To book an appointment, first find a barber you like, then click on their profile and use the 'Book Appointment' button. You'll need to be logged in to book appointments.";
        }

        // Service responses
        if (message.includes('service') || message.includes('haircut') || message.includes('beard') || message.includes('price')) {
            return "We offer a wide range of services including haircuts, beard grooming, styling, and special treatments. Prices typically range from $15-60 depending on the service. Check our Services page for detailed information!";
        }

        // General help
        if (message.includes('help') || message.includes('how') || message.includes('what')) {
            return "I'm here to help! I can assist with finding barbers, booking appointments, service information, and general questions about BarberFinder. What would you like to know?";
        }

        // Default responses
        const responses = [
            "That's a great question! Let me help you with that.",
            "I'd be happy to assist you with that.",
            "Let me provide you with some helpful information.",
            "I can definitely help you with that question.",
            "That's something I can help you with!"
        ];

        return responses[Math.floor(Math.random() * responses.length)] + " Could you please rephrase your question or ask about finding barbers, booking appointments, or our services?";
    }
});
</script>

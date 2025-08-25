<!-- Chatbot Component -->
<div id="chatbot-container" class="fixed bottom-4 right-4 z-50">
    <!-- Chat Button -->
    <button 
        id="chatbot-toggle" 
        class="text-white rounded-full p-4 shadow-2xl transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-orange-300/50 hover:shadow-3xl"
        aria-label="Ouvrir le chat avec Ama">
        <i data-lucide="brain" class="w-6 h-6"></i>
    </button>

    <!-- Chat Window -->
    <div 
        id="chatbot-window" 
        class="hidden fixed bottom-20 right-4 w-96 max-w-[calc(100vw-2rem)] bg-white rounded-md shadow-2xl border border-gray-200 flex flex-col overflow-hidden"
        style="height: 600px; max-height: calc(100vh - 8rem);">
        
        <!-- Header -->
        <div class="flex items-center justify-between p-4 border-b text-white" style="background: linear-gradient(135deg, #FF6B00 0%, #E55A00 100%);">
            <div class="flex items-center space-x-2">
                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                <h3 class="font-medium text-sm">Ama</h3>
            </div>
            <button 
                id="chatbot-close" 
                class="text-white hover:text-gray-200 transition-colors focus:outline-none p-1"
                aria-label="Fermer le chat">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Messages Container -->
        <div id="chatbot-messages" class="flex-1 overflow-y-auto p-4 space-y-4">
            <!-- Welcome Message -->
            <div class="text-gray-700">
                <div class="text-sm text-gray-800 bg-gray-100 px-4 py-2 rounded-lg max-w-[80%]">
                    Bonjour ! Je suis Ama, votre assistant virtuel du Hub Ivoire Tech. Comment puis-je vous aider aujourd'hui ?
                </div>
            </div>
        </div>

        <!-- Thinking Indicator -->
        <div id="chatbot-thinking" class="hidden px-4 py-2">
            <div class="text-gray-500 text-sm italic bg-gray-100 px-4 py-2 rounded-lg max-w-[80%] shimmer-effect">
                <span class="shimmer-text">Ama réfléchit...</span>
            </div>
        </div>

        <!-- Input Form -->
        <form id="chatbot-form" class="p-4 border-t bg-gray-50">
            <!-- Suggestion Bubbles -->
            <div id="suggestion-bubbles" class="flex flex-wrap gap-2 mb-3">
                <button class="suggestion-bubble bg-white border border-gray-300 hover:border-orange-400 hover:bg-orange-50 px-3 py-2 rounded-lg text-sm text-gray-700 transition-all duration-200" data-suggestion="Découvrir vos espaces de travail">
                    💼 Découvrir vos espaces
                </button>
                <button class="suggestion-bubble bg-white border border-gray-300 hover:border-orange-400 hover:bg-orange-50 px-3 py-2 rounded-lg text-sm text-gray-700 transition-all duration-200" data-suggestion="Voir les événements à venir">
                    📅 Événements à venir
                </button>
                <button class="suggestion-bubble bg-white border border-gray-300 hover:border-orange-400 hover:bg-orange-50 px-3 py-2 rounded-lg text-sm text-gray-700 transition-all duration-200" data-suggestion="Comment devenir membre du hub ?">
                    🚀 Devenir membre
                </button>
            </div>
            
            <div class="flex items-center border border-gray-300 bg-white rounded-lg">
                <input 
                    type="text" 
                    id="chatbot-input" 
                    placeholder="Tapez votre message..."
                    class="flex-1 px-4 py-3 bg-transparent border-0 text-sm"
                    style="outline: none !important; box-shadow: none !important;"
                    maxlength="1000">
                <button 
                    type="submit" 
                    class="mr-2 text-white p-2 rounded-md transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed hover:scale-105 active:scale-95"
                    style="background-color: #FF6B00; outline: none !important;"
                    aria-label="Envoyer">
                    <i data-lucide="send" class="w-4 h-4"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Chatbot Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Attendre que Lucide soit chargé puis initialiser
    function initializeLucide() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
            console.log('Lucide icons initialized');
        } else {
            setTimeout(initializeLucide, 100);
        }
    }
    initializeLucide();
    
    const chatbotToggle = document.getElementById('chatbot-toggle');
    const chatbotWindow = document.getElementById('chatbot-window');
    const chatbotClose = document.getElementById('chatbot-close');
    const chatbotForm = document.getElementById('chatbot-form');
    const chatbotInput = document.getElementById('chatbot-input');
    const chatbotMessages = document.getElementById('chatbot-messages');
    const chatbotThinking = document.getElementById('chatbot-thinking');
    
    let conversationContext = [];
    let isProcessing = false;

    // Toggle chat window
    chatbotToggle.addEventListener('click', function() {
        chatbotWindow.classList.toggle('hidden');
        chatbotToggle.classList.toggle('hidden');
        if (!chatbotWindow.classList.contains('hidden')) {
            chatbotInput.focus();
        }
    });

    // Close chat window
    chatbotClose.addEventListener('click', function() {
        chatbotWindow.classList.add('hidden');
        chatbotToggle.classList.remove('hidden');
    });

    // Handle form submission
    chatbotForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        if (isProcessing) return;
        
        const message = chatbotInput.value.trim();
        if (!message) return;

        // Add user message
        addMessage(message, 'user');
        chatbotInput.value = '';
        
        // Show thinking indicator
        showThinking();
        isProcessing = true;

        try {
            // Send message to API
            const response = await fetch('{{ route('chatbot.message') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    message: message,
                    context: conversationContext.slice(-5) // Send last 5 messages for context
                })
            });

            const data = await response.json();
            
            // Hide thinking indicator
            hideThinking();
            
            if (data.success) {
                // Add bot response
                addMessage(data.message, 'bot');
                
                // Update context
                conversationContext.push(
                    { role: 'user', content: message },
                    { role: 'assistant', content: data.message }
                );
            } else {
                addMessage(data.message || 'Une erreur est survenue. Veuillez réessayer.', 'bot');
            }
        } catch (error) {
            console.error('Chatbot error:', error);
            hideThinking();
            addMessage('Je rencontre des difficultés techniques. Veuillez réessayer plus tard.', 'bot');
        } finally {
            isProcessing = false;
        }
    });

    // Add message to chat
    function addMessage(text, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.className = sender === 'user' 
            ? 'flex justify-end' 
            : 'text-gray-700';
        
        if (sender === 'user') {
            messageDiv.innerHTML = `
                <div class="text-white px-4 py-2 max-w-[80%] text-sm rounded-lg" style="background-color: #FF6B00;">
                    ${escapeHtml(text)}
                </div>
            `;
        } else {
            // Process links in bot messages
            const processedText = processLinks(text);
            messageDiv.innerHTML = `
                <div class="text-sm text-gray-800 bg-gray-100 px-4 py-2 rounded-lg max-w-[80%]">
                    ${processedText}
                </div>
            `;
        }
        
        chatbotMessages.appendChild(messageDiv);
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
        
        // Réinitialiser les icônes Lucide après ajout de contenu
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }

    // Process links in text
    function processLinks(text) {
        // Replace URLs with clickable links
        const urlRegex = /(\/[a-zA-Z0-9\-\/]+)/g;
        return text.replace(urlRegex, '<a href="$1" class="text-primary hover:underline">$1</a>');
    }

    // Show thinking indicator
    function showThinking() {
        // Append thinking indicator to messages container instead of separate div
        const thinkingDiv = document.createElement('div');
        thinkingDiv.id = 'thinking-message';
        thinkingDiv.className = 'text-gray-700';
        thinkingDiv.innerHTML = `
            <div class="text-sm italic bg-gray-100 px-4 py-2 rounded-lg max-w-[80%] shimmer-effect">
                <span class="shimmer-text">Ama réfléchit...</span>
            </div>
        `;
        chatbotMessages.appendChild(thinkingDiv);
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
        
        // Reinitialize Lucide icons
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }

    // Hide thinking indicator
    function hideThinking() {
        const thinkingMessage = document.getElementById('thinking-message');
        if (thinkingMessage) {
            thinkingMessage.remove();
        }
    }

    // Escape HTML
    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, m => map[m]);
    }

    // Handle Enter key
    chatbotInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            chatbotForm.dispatchEvent(new Event('submit'));
        }
    });

    // Handle suggestion bubbles clicks
    function handleSuggestionClick(suggestion) {
        chatbotInput.value = suggestion;
        chatbotForm.dispatchEvent(new Event('submit'));
        
        // Hide suggestion bubbles after first use
        const suggestionBubbles = document.getElementById('suggestion-bubbles');
        if (suggestionBubbles) {
            suggestionBubbles.style.display = 'none';
        }
    }

    // Add event listeners to suggestion bubbles
    document.querySelectorAll('.suggestion-bubble').forEach(bubble => {
        bubble.addEventListener('click', function() {
            const suggestion = this.getAttribute('data-suggestion');
            handleSuggestionClick(suggestion);
        });
    });
});
</script>

<!-- Mobile Responsive Styles -->
<style>
@media (max-width: 640px) {
    #chatbot-window {
        width: calc(100vw - 2rem);
        right: 1rem;
        bottom: 5rem;
        height: calc(100vh - 10rem);
    }
    
    #chatbot-container button#chatbot-toggle {
        bottom: 1rem;
        right: 1rem;
    }
}

/* Chatbot button styling */
#chatbot-toggle {
    background-color: #FF6B00 !important;
}

#chatbot-toggle:hover {
    background-color: #E55A00 !important;
    transform: scale(1.1);
}

/* Send button styling */
#chatbot-form button[type="submit"] {
    background-color: #FF6B00 !important;
}

#chatbot-form button[type="submit"]:hover {
    background-color: #E55A00 !important;
}

/* Input styling - remove all focus outlines */
#chatbot-input {
    outline: none !important;
    box-shadow: none !important;
}

#chatbot-input:focus {
    outline: none !important;
    box-shadow: none !important;
    border-color: #FF6B00 !important;
}

/* Remove focus outline from all chatbot elements */
#chatbot-form *:focus {
    outline: none !important;
    box-shadow: none !important;
}

/* Suggestion bubbles styling */
.suggestion-bubble {
    cursor: pointer;
    white-space: nowrap;
}

.suggestion-bubble:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Custom scrollbar for messages container */
#chatbot-messages::-webkit-scrollbar {
    width: 6px;
}

#chatbot-messages::-webkit-scrollbar-track {
    background: transparent;
    border-radius: 10px;
}

#chatbot-messages::-webkit-scrollbar-thumb {
    background: #d1d5db;
    border-radius: 10px;
}

#chatbot-messages::-webkit-scrollbar-thumb:hover {
    background: #9ca3af;
}

/* Shimmer effect for thinking indicator */
@keyframes shimmer {
    0% {
        background-position: -200px 0;
    }
    100% {
        background-position: 200px 0;
    }
}

.shimmer-effect {
    position: relative;
    overflow: hidden;
}

.shimmer-effect::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, 
        transparent 0%, 
        rgba(255, 255, 255, 0.4) 50%, 
        transparent 100%);
    animation: shimmerSlide 1.5s ease-in-out infinite;
}

@keyframes shimmerSlide {
    0% {
        left: -100%;
    }
    100% {
        left: 100%;
    }
}

.shimmer-text {
    background: linear-gradient(90deg, 
        #6b7280 0%, 
        #9ca3af 50%, 
        #6b7280 100%);
    background-size: 200px 100%;
    -webkit-background-clip: text;
    background-clip: text;
    animation: shimmerText 1.5s ease-in-out infinite;
}

@keyframes shimmerText {
    0% {
        background-position: -200px 0;
    }
    100% {
        background-position: 200px 0;
    }
}
</style>
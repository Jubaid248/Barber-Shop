<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barber;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class ChatbotController extends Controller
{
    /**
     * Handle chatbot messages and generate AI responses
     */
    public function chat(Request $request)
    {
        $message = $request->input('message');
        $response = $this->generateAIResponse($message);

        return response()->json([
            'response' => $response,
            'timestamp' => now()
        ]);
    }

    /**
     * Generate AI response based on user message
     */
    private function generateAIResponse($userMessage)
    {
        $message = strtolower(trim($userMessage));

        // Barber finding responses
        if ($this->containsAny($message, ['find', 'barber', 'search', 'near me', 'location'])) {
            return $this->getBarberFindingResponse($message);
        }

        // Appointment responses
        if ($this->containsAny($message, ['book', 'appointment', 'schedule', 'reserve', 'booking'])) {
            return $this->getAppointmentResponse($message);
        }

        // Service responses
        if ($this->containsAny($message, ['service', 'haircut', 'beard', 'price', 'cost', 'fee'])) {
            return $this->getServiceResponse($message);
        }

        // Account/User responses
        if ($this->containsAny($message, ['account', 'login', 'register', 'sign up', 'profile'])) {
            return $this->getAccountResponse($message);
        }

        // General help responses
        if ($this->containsAny($message, ['help', 'how', 'what', 'why', 'when', 'where'])) {
            return $this->getHelpResponse($message);
        }

        // Greeting responses
        if ($this->containsAny($message, ['hello', 'hi', 'hey', 'good morning', 'good afternoon', 'good evening'])) {
            return $this->getGreetingResponse();
        }

        // Default response
        return $this->getDefaultResponse();
    }

    /**
     * Check if message contains any of the specified keywords
     */
    private function containsAny($message, $keywords)
    {
        foreach ($keywords as $keyword) {
            if (str_contains($message, $keyword)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Generate barber finding response
     */
    private function getBarberFindingResponse($message)
    {
        $responses = [
            "I can help you find barbers! 🎯 Use our search feature to discover barbers near you. You can filter by:",
            "• Location and distance",
            "• Services offered",
            "• Ratings and reviews",
            "• Price range",
            "• Availability",
            "",
            "Just click 'Find Barbers' in the navigation or visit our search page to get started!"
        ];

        return implode("\n", $responses);
    }

    /**
     * Generate appointment response
     */
    private function getAppointmentResponse($message)
    {
        $responses = [
            "Great! Here's how to book an appointment: 📅",
            "",
            "1. Find a barber you like using our search",
            "2. Click on their profile to view details",
            "3. Click the 'Book Appointment' button",
            "4. Choose your preferred date and time",
            "5. Select your service and confirm",
            "",
            "Note: You'll need to be logged in to book appointments. Don't have an account? Sign up for free!"
        ];

        return implode("\n", $responses);
    }

    /**
     * Generate service response
     */
    private function getServiceResponse($message)
    {
        $responses = [
            "We offer a comprehensive range of barber services! ✂️",
            "",
            "• Haircuts (Classic, Modern, Fade, Taper)",
            "• Beard Grooming & Shaping",
            "• Hot Towel Shaves",
            "• Hair Styling & Treatments",
            "• Special Services (Head Shave, Eyebrow Grooming)",
            "• Package Deals",
            "",
            "Prices typically range from $15-60 depending on the service. Check our Services page for detailed pricing and descriptions!"
        ];

        return implode("\n", $responses);
    }

    /**
     * Generate account response
     */
    private function getAccountResponse($message)
    {
        $responses = [
            "Account management is easy! 👤",
            "",
            "• Create an account: Click 'Sign Up' in the navigation",
            "• Login: Use your email and password",
            "• Profile: Access your dashboard to manage appointments",
            "• Become a Barber: Apply through your dashboard",
            "",
            "Having trouble? Our support team is here to help!"
        ];

        return implode("\n", $responses);
    }

    /**
     * Generate help response
     */
    private function getHelpResponse($message)
    {
        $responses = [
            "I'm here to help! 🤖 Here are some common topics I can assist with:",
            "",
            "• Finding barbers near you",
            "• Booking appointments",
            "• Service information and pricing",
            "• Account management",
            "• General platform questions",
            "",
            "Just ask me anything about BarberFinder and I'll do my best to help!"
        ];

        return implode("\n", $responses);
    }

    /**
     * Generate greeting response
     */
    private function getGreetingResponse()
    {
        $greetings = [
            "Hello! 👋 Welcome to BarberFinder! How can I assist you today?",
            "Hi there! 😊 I'm your AI barber assistant. What would you like to know?",
            "Hey! 🎉 Great to see you! How can I help you find the perfect barber?",
            "Good day! ✨ I'm here to help you with all things barber-related. What's on your mind?"
        ];

        return $greetings[array_rand($greetings)];
    }

    /**
     * Generate default response
     */
    private function getDefaultResponse()
    {
        $responses = [
            "That's an interesting question! 🤔 I'm here to help with barber-related topics. Could you try asking about:",
            "",
            "• Finding barbers near you",
            "• Booking appointments",
            "• Our services and pricing",
            "• Account management",
            "• General platform help",
            "",
            "Or feel free to rephrase your question!"
        ];

        return implode("\n", $responses);
    }

    /**
     * Get quick action suggestions
     */
    public function getQuickActions()
    {
        return response()->json([
            'actions' => [
                [
                    'title' => 'Find Barbers',
                    'description' => 'Search for barbers near you',
                    'action' => 'search',
                    'icon' => 'fas fa-search'
                ],
                [
                    'title' => 'Book Appointment',
                    'description' => 'Schedule your next haircut',
                    'action' => 'book',
                    'icon' => 'fas fa-calendar-plus'
                ],
                [
                    'title' => 'View Services',
                    'description' => 'See what services we offer',
                    'action' => 'services',
                    'icon' => 'fas fa-cut'
                ],
                [
                    'title' => 'Get Help',
                    'description' => 'Learn how to use BarberFinder',
                    'action' => 'help',
                    'icon' => 'fas fa-question-circle'
                ]
            ]
        ]);
    }
}

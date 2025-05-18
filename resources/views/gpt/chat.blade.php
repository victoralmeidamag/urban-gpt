<!-- Exemplo de blade view para usar a API do GPT (Versão com layout expandido e textarea ajustável) -->
@extends('layouts.app')

@push('styles')
<style>
    body, html {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }
    
    .container {
        width: 95%;
        max-width: 1200px;
        padding: 0;
        margin: 0 auto;
    }
    
    .card {
        height: auto;
        margin: 0;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }
    
    .card-body {
        flex: 1;
        padding: 0;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }
    
    #chat-container {
        width: 100%;
        display: flex;
        flex-direction: column;
        padding: 10px;
        height: calc(100vh - 220px); /* Ajustado para considerar navbar e footer */
    }
    
    #chat-messages {
        flex: 1;
        overflow-y: auto;
        padding: 10px;
        background-color: #f9f9f9;
        border-radius: 8px;
        margin-bottom: 10px;
        border: 1px solid #eaeaea;
        height: calc(100vh - 320px); /* Altura ajustada considerando componentes da página */
        min-height: 200px;
    }
    
    .message {
        padding: 8px 12px;
        margin-bottom: 8px;
        border-radius: 8px;
        max-width: 85%;
        word-wrap: break-word;
    }
    
    .message.user {
        background-color: #dcf8c6;
        margin-left: auto;
        text-align: right;
    }
    
    .message.assistant {
        background-color: #f1f0f0;
    }
    
    .message.assistant p {
        margin-bottom: 8px;
        text-align: left;
    }
    
    .message.assistant strong {
        color: #0056b3;
    }
    
    .message.assistant ul, .message.assistant ol {
        padding-left: 20px;
        margin-bottom: 10px;
        text-align: left;
    }
    
    .message.assistant li {
        margin-bottom: 5px;
    }
    
    .message.system {
        background-color: #ffdddd;
        text-align: center;
        margin: 10px auto;
    }
    
    .typing-indicator {
        padding: 10px;
        background-color: #f1f0f0;
        border-radius: 8px;
        margin-bottom: 10px;
        width: fit-content;
        display: none;
    }
    
    .typing-indicator span {
        height: 8px;
        width: 8px;
        margin: 0 2px;
        background-color: #9e9ea1;
        display: inline-block;
        border-radius: 50%;
        animation: bounce 1.3s linear infinite;
    }
    
    .typing-indicator span:nth-child(2) {
        animation-delay: 0.2s;
    }
    
    .typing-indicator span:nth-child(3) {
        animation-delay: 0.4s;
    }
    
    .input-group {
        margin-top: auto;
        position: relative;
        padding: 0 5px 5px 5px;
    }
    
    .auto-expanding-textarea {
        min-height: 40px;
        max-height: 80px;
        overflow-y: auto;
        resize: none;
        padding-right: 60px; /* Espaço para o botão */
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    
    #send-message {
        position: absolute;
        right: 10px;
        bottom: 10px;
        z-index: 10;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    @keyframes bounce {
        0%, 60%, 100% { transform: translateY(0); }
        30% { transform: translateY(-4px); }
    }
    
    @media (max-width: 768px) {
        .container {
            width: 100%;
            padding: 0;
        }
        
        #chat-container {
            height: calc(100vh - 200px);
            padding: 5px;
        }
        
        #chat-messages {
            padding: 8px;
            height: calc(100vh - 300px);
            min-height: 180px;
        }
        
        .message {
            max-width: 90%;
        }
        
        .card-header h5 {
            font-size: 1rem;
        }
    }
</style>
@endpush

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10 col-md-12">
        <div class="card shadow">
<div class="card-header py-2" style="background-color: #ede2d4; color: #000;">
    <h5 class="mb-0" style="color: #ea5473"><i class="bi bi-chat-dots"></i> <strong>IA UrbanGuide</strong></h5>
</div>


                <div class="card-body">
                    <div id="chat-container">
                        <div id="chat-messages">
                            <!-- Mensagem de boas-vindas -->
                            <div class="message assistant">
                                <strong>GPT:</strong> Olá! Como posso ajudar você hoje?
                            </div>
                            <!-- Indicador de digitação -->
                            <div class="typing-indicator" id="typing-indicator">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>

                        <div class="input-group">
                            <textarea id="user-message" class="form-control auto-expanding-textarea" placeholder="Digite sua mensagem..." rows="1"></textarea>
                            <button id="send-message" class="btn btn-primary">
                                <i class="bi bi-send"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatMessages = document.getElementById('chat-messages');
        const userMessage = document.getElementById('user-message');
        const sendButton = document.getElementById('send-message');
        const typingIndicator = document.getElementById('typing-indicator');
        
        // Adicionar mensagem de boas-vindas ao histórico
        let messageHistory = [
            { role: 'assistant', content: 'Olá! Como posso ajudar você hoje?' }
        ];
        
        // Função para auto-expandir o textarea conforme digita
        function autoResizeTextarea() {
            // Reset height para calcular corretamente
            userMessage.style.height = 'auto';
            
            // Definir a altura baseada no scrollHeight
            userMessage.style.height = Math.min(userMessage.scrollHeight, 150) + 'px';
        }
        
        // Aplicar evento para ajustar tamanho conforme digita
        userMessage.addEventListener('input', autoResizeTextarea);
        
        // Função para mostrar o indicador de digitação
        function showTypingIndicator() {
            typingIndicator.style.display = 'block';
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
        
        // Função para ocultar o indicador de digitação
        function hideTypingIndicator() {
            typingIndicator.style.display = 'none';
        }
        
        // Função para adicionar mensagem ao chat
        function addMessage(role, content) {
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('message', role);
            
            // Formatar o conteúdo da mensagem
            let formattedContent = content;
            
            // Aplicar formatação, se for mensagem do assistente
            if (role === 'assistant') {
                // Converter listas numeradas para HTML
                formattedContent = formattedContent.replace(/(\d+)\.\s+\*\*(.*?)\*\*:/g, '<strong>$1. $2:</strong>');
                formattedContent = formattedContent.replace(/(\d+)\.\s+\*\*(.*?)\*\*/g, '<strong>$1. $2</strong>');
                
                // Converter listas numeradas simples
                formattedContent = formattedContent.replace(/(\d+)\.\s+(.*?)(?=\n|$)/g, '<p><strong>$1.</strong> $2</p>');
                
                // Converter negrito para HTML
                formattedContent = formattedContent.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
                
                // Converter itálico para HTML
                formattedContent = formattedContent.replace(/\*(.*?)\*/g, '<em>$1</em>');
                
                // Substituir quebras de linha por tags de parágrafo HTML
                formattedContent = formattedContent.replace(/\n\n/g, '</p><p>');
                
                // Envolver todo o conteúdo em parágrafos se não estiver
                if (!formattedContent.startsWith('<p>')) {
                    formattedContent = '<p>' + formattedContent;
                }
                if (!formattedContent.endsWith('</p>')) {
                    formattedContent += '</p>';
                }
            }
            
            messageDiv.innerHTML = `<strong>${role === 'user' ? 'Você' : 'GPT'}:</strong> ${formattedContent}`;
            
            // Inserir antes do indicador de digitação
            chatMessages.insertBefore(messageDiv, typingIndicator);
            chatMessages.scrollTop = chatMessages.scrollHeight;
            
            // Adicionar ao histórico
            messageHistory.push({ role, content });
        }
        
        async function sendToGpt(message) {
    try {
        showTypingIndicator();
        
        // Criar o histórico completo com a instrução do sistema
        const fullMessageHistory = [
            {
                role: 'system',
                content: 'Você é um assistente especialista em zoneamento urbano no Brasil. Sua função é fornecer respostas completas, diretas e técnicas sobre o uso e ocupação do solo de qualquer endereço brasileiro informado. Consulte prioritariamente fontes oficiais. Forneça todos os parâmetros urbanísticos necessários: zoneamento, coeficiente de aproveitamento, taxa de ocupação, taxa de permeabilidade, recuos mínimos, altura máxima, restrições legais e exigências do município. Responda de forma estruturada e técnica, sem placeholders.'
            },
            ...messageHistory
        ];
        
        const response = await fetch('/api/gpt/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                messages: fullMessageHistory, // Enviar o histórico completo com a instrução
                temperature: 0.3, // Reduzido para respostas mais precisas
                model: 'gpt-4o'
            })
        });
        
        const data = await response.json();
        
        hideTypingIndicator();
        
        if (data.success) {
            const gptResponse = data.data.message.content;
            addMessage('assistant', gptResponse);
        } else {
            addMessage('system', 'Erro ao processar a mensagem. Por favor, tente novamente.');
        }
    } catch (error) {
        hideTypingIndicator();
        addMessage('system', 'Erro de conexão. Por favor, verifique sua internet e tente novamente.');
        console.error('Erro na chamada da API:', error);
    }
}
        
        // Função para processar o envio da mensagem
        function handleSendMessage() {
            const message = userMessage.value.trim();
            if (message) {
                addMessage('user', message);
                userMessage.value = '';
                // Resetar altura do textarea após envio
                userMessage.style.height = 'auto';  
                sendToGpt(message);
            }
        }
        
        // Event listener para o botão de enviar
        sendButton.addEventListener('click', handleSendMessage);
        
        // Event listener para tecla Enter (sem shift)
        userMessage.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault(); // Impedir quebra de linha
                handleSendMessage();
            }
        });
        
        // Focar o textarea ao carregar a página
        userMessage.focus();
    });
</script>
@endpush
<!-- Link a Google Fonts Rubik -->
<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">

<div class="absolute left-1/2 transform -translate-x-1/2 top-32 -translate-y-1/2 z-10 w-full md:max-w-6xl px-4 font-['Rubik']">
    <div class="relative bg-[#F4E6D4] rounded-[2rem] px-8 py-12 flex flex-col md:flex-row items-center justify-between gap-8 md:gap-12 shadow-[0_20px_50px_rgba(0,0,0,0.1)] overflow-hidden group">
        
        <!-- Decoración de fondo sutil -->
        <div class="absolute -right-16 -top-16 w-64 h-64 bg-[#FF8A65] opacity-5 rounded-full blur-3xl pointer-events-none group-hover:opacity-10 transition-opacity duration-700"></div>
        <div class="absolute -left-16 -bottom-16 w-64 h-64 bg-white opacity-20 rounded-full blur-3xl pointer-events-none group-hover:opacity-30 transition-opacity duration-700"></div>

        <!-- Columna de Texto -->
        <div class="flex-1 text-left max-w-full md:max-w-lg relative z-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#FF8A65]/10 text-[#FF8A65] text-xs font-bold uppercase tracking-wider mb-4 border border-[#FF8A65]/20">
                <i class="fa-solid fa-paper-plane animate-bounce"></i>
                Newsletter
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight mb-4">
                {{ $content['title'] }}
            </h2>
            <p class="text-base md:text-lg text-gray-700/80 leading-relaxed font-medium">
                {{ $content['description'] }}
            </p>
        </div>

        <!-- Columna Formulario -->
        <div class="w-full max-w-md relative z-10">
            <form id="newsletterForm" class="relative group/form">
                @csrf
                
                <!-- Mensaje de feedback relocalizado -->
                <div id="newsletterMessage" 
                    class="mb-4 h-0 overflow-hidden opacity-0 transition-all duration-500 rounded-xl text-white font-bold flex items-center gap-3 backdrop-blur-md">
                </div>

                <div id="newsletterInputGroup" class="flex flex-col sm:flex-row items-center gap-3 bg-white/50 p-2 rounded-2xl backdrop-blur-sm border border-white shadow-inner transition-all duration-500">
                    <div class="relative flex-1 w-full">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <i class="fa-solid fa-envelope"></i>
                        </span>
                        <input 
                            type="email" 
                            name="email" 
                            placeholder="{{ $content['emailExample'] ?? 'Tu correo electrónico...' }}" 
                            class="text-gray-800 placeholder-gray-400/80 bg-transparent border-none pl-11 pr-4 py-3 w-full rounded-xl focus:outline-none focus:ring-0 transition-all text-sm md:text-base"
                            required
                        >
                    </div>
                    
                    <button 
                        id="newsletterBtn"
                        type="submit" 
                        class="relative overflow-hidden group/btn bg-[#FF8A65] text-white px-8 py-3 rounded-xl hover:bg-[#ff7b54] transition-all w-full sm:w-auto font-bold shadow-[0_10px_20px_-5px_rgba(255,138,101,0.4)] flex justify-center items-center min-w-[140px] active:scale-95"
                    >
                        <!-- Efecto de brillo al pasar el mouse -->
                        <span class="absolute top-0 -left-full w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent skew-x-[-30deg] group-hover/btn:left-full transition-all duration-700 pointer-events-none"></span>
                        
                        <span id="newsletterBtnText" class="flex items-center gap-2">
                            {{ $content['btnTittle'] ?? 'Suscribirme' }}
                            <i class="fa-solid fa-arrow-right group-hover/btn:translate-x-1 transition-transform"></i>
                        </span>
                        <span id="newsletterBtnLoader" class="hidden">
                            <i class="fa-solid fa-circle-notch fa-spin"></i>
                        </span>
                    </button>
                </div>
                
                <!-- Micro texto de aviso -->
                <p class="mt-3 text-[10px] text-gray-500/80 text-center sm:text-left px-2">
                    <i class="fa-solid fa-lock mr-1"></i> Tu información está segura con nosotros. Sin spam.
                </p>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('newsletterForm');
    const messageBox = document.getElementById('newsletterMessage');
    const inputGroup = document.getElementById('newsletterInputGroup');
    const btn = document.getElementById('newsletterBtn');
    const btnText = document.getElementById('newsletterBtnText');
    const btnLoader = document.getElementById('newsletterBtnLoader');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Estado de carga premium
        btn.disabled = true;
        btn.classList.add('opacity-80', 'cursor-not-allowed');
        btnText.classList.add('hidden');
        btnLoader.classList.remove('hidden');

        const formData = new FormData(form);

        fetch("{{ route('newsletter.store') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': formData.get('_token'),
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'success') {
                form.reset();
                showMessage('success', data.message);
            } else {
                showMessage('error', data.message);
            }
        })
        .catch(err => {
            showMessage('error', 'Ocurrió un error inesperado. Intenta de nuevo.');
        })
        .finally(() => {
            // Restaurar estado
            btn.disabled = false;
            btn.classList.remove('opacity-80', 'cursor-not-allowed');
            btnText.classList.remove('hidden');
            btnLoader.classList.add('hidden');
        });
    });

    function showMessage(status, text) {
        const isSuccess = status === 'success';
        const icon = isSuccess ? '<i class="fa-solid fa-circle-check text-xl"></i>' : '<i class="fa-solid fa-circle-exclamation text-xl"></i>';
        
        messageBox.innerHTML = `${icon} <span class="text-sm">${text}</span>`;
        messageBox.classList.remove('bg-emerald-600/90', 'bg-rose-600/90', 'p-4', 'h-0', 'mb-4', 'opacity-0');
        messageBox.classList.add(isSuccess ? 'bg-emerald-600/90' : 'bg-rose-600/90', 'p-4', 'mb-4', 'opacity-100');
        messageBox.style.height = 'auto';

        // Si es éxito, podemos ocultar el input sutilmente
        if(isSuccess) {
            inputGroup.classList.add('opacity-50', 'pointer-events-none', 'scale-95');
        }

        setTimeout(() => {
            messageBox.classList.add('opacity-0', 'h-0', 'mb-0');
            messageBox.classList.remove('p-4', 'opacity-100', 'mb-4');
            messageBox.style.height = '0px';
            
            // Restaurar visibilidad del input
            inputGroup.classList.remove('opacity-50', 'pointer-events-none', 'scale-95');
        }, 5000);
    }
});
</script>

    function confettiEffect() {
        // Podríamos disparar un efecto sutil, pero por ahora mantendremos el código ligero.
        console.log('Subscription successful!');
    }
});
</script>


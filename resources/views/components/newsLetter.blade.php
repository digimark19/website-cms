<div class="absolute left-1/2 transform -translate-x-1/2 -top-24 z-10 w-full md:max-w-6xl px-4">
    <div class="bg-[#F4E6D4] rounded-2xl px-8 py-10 flex flex-col md:flex-row items-center justify-between gap-12 shadow-xl w-full">
        <!-- Texto -->
        <div class="flex-1 text-left max-w-full md:max-w-lg">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 leading-snug mb-3">
                {{ $content['title'] }}
            </h2>
            <p class="text-sm md:text-base text-gray-700 leading-relaxed">
                {{ $content['description'] }}
            </p>
        </div>

        <!-- Formulario -->
        <form id="newsletterForm" class="flex flex-col sm:flex-row items-center justify-end gap-4 w-full max-w-md">
            @csrf
            <input 
                type="email" 
                name="email" 
                placeholder="{{ $content['emailExample'] ?? 'Introduce tu correo electrónico' }}" 
                class="text-gray-800 placeholder-gray-400 bg-white border border-gray-300 px-4 py-3 w-full sm:flex-1 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FF8A65] focus:border-transparent"
                required
            >
            <button 
                type="submit" 
                class="bg-[#FF8A65] text-white px-6 py-3 rounded-lg hover:bg-[#ff7b54] transition-all w-full sm:w-auto font-semibold shadow-md"
            >
                {{ $content['btnTittle'] ?? 'Suscribirme' }}
            </button>
        </form>
    </div>
</div>

<!-- Mensaje emergente fijo -->
<div id="newsletterMessage" 
    class="fixed top-6 left-1/2 transform -translate-x-1/2 px-6 py-4 rounded-lg text-white font-semibold opacity-0 pointer-events-none transition-all duration-500 z-50 shadow-lg">
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('newsletterForm');
    const messageBox = document.getElementById('newsletterMessage');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

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
            showMessage(data.status, data.message);
            if(data.status === 'success') form.reset();
        })
        .catch(err => {
            showMessage('error', 'Ocurrió un error, intenta de nuevo.');
        });
    });

    function showMessage(status, text) {
        messageBox.textContent = text;
        messageBox.classList.remove('bg-green-500', 'bg-red-500', 'opacity-0');
        messageBox.classList.add(status === 'success' ? 'bg-green-500' : 'bg-red-500', 'opacity-100');

        messageBox.style.transform = 'translate(-50%, 0px)';
        messageBox.style.pointerEvents = 'auto';

        setTimeout(() => {
            messageBox.classList.remove('opacity-100');
            messageBox.classList.add('opacity-0');
            messageBox.style.transform = 'translate(-50%, -20px)';
            messageBox.style.pointerEvents = 'none';
        }, 3000);
    }
});
</script>

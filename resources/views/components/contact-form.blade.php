@props(['tipo' => ''])
@if($content)
@php
    $uid = uniqid('form_'); // ID único para evitar conflictos
@endphp

<div class="max-w-3xl mx-auto font-rubik">
    <p class="text-gray-700 mb-6">
        {{ $content['description'] }}
    </p>

    <!-- MENSAJE -->
    <div id="formMessage-{{ $uid }}" class="hidden mb-4 p-3 rounded text-white text-sm"></div>

    <form id="contactForm-{{ $uid }}" class="space-y-6">

        <!-- Input Hidden -->
        <input type="hidden" name="tipo" id="tipo-{{ $uid }}" value="{{ $tipo }}">
        <input type="hidden" name="url" value="{{ url()->current() }}">

        <!-- GRID 2 COLUMNAS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Nombre -->
            <div>
                <label class="label-required">{{ $content['label_nombre'] }} <span>*</span></label>
                <input type="text" name="nombre" class="input-modern required-field">
            </div>

            <!-- Apellido -->
            <div>
                <label class="label-required">{{ $content['label_apellido'] }} <span>*</span></label>
                <input type="text" name="apellido" class="input-modern required-field">
            </div>

            <!-- Correo -->
            <div>
                <label class="label-required">{{ $content['label_correo'] }} <span>*</span></label>
                <input type="email" name="correo" class="input-modern required-field">
            </div>

            <!-- Ciudad -->
            <div>
                <label class="label-required">{{ $content['label_ciudad'] }} <span>*</span></label>
                <input type="text" name="ciudad" class="input-modern required-field">
            </div>
        </div>

        <!-- Teléfono con Lada -->
        <div class="mt-4" x-data="{ 
            open: false, 
            selectedLada: '+52', 
            selectedFlag: '🇲🇽',
            ladas: [
                { code: '+52', flag: '🇲🇽', name: 'México' },
                { code: '+1', flag: '🇺🇸', name: 'USA' },
                { code: '+57', flag: '🇨🇴', name: 'Colombia' },
                { code: '+54', flag: '🇦🇷', name: 'Argentina' },
                { code: '+34', flag: '🇪🇸', name: 'España' },
                { code: '+56', flag: '🇨🇱', name: 'Chile' },
                { code: '+51', flag: '🇵🇪', name: 'Perú' }
            ]
        }">
            <label class="label-required">{{ $content['label_telefono'] }} <span>*</span></label>
            <div class="flex gap-2 relative">
                {{-- Hidden input for the form --}}
                <input type="hidden" name="lada" :value="selectedLada">

                {{-- Custom Selector --}}
                <div class="w-28 flex-shrink-0 relative">
                    <button 
                        @click="open = !open" 
                        type="button"
                        class="input-modern w-full flex items-center justify-between cursor-pointer text-sm bg-[#F5F5F5] px-3 py-3 rounded-md"
                    >
                        <span x-text="selectedFlag + ' ' + selectedLada"></span>
                        <i class="fas fa-chevron-down text-xs opacity-50"></i>
                    </button>

                    {{-- Dropdown List --}}
                    <div 
                        x-show="open" 
                        @click.away="open = false"
                        class="absolute left-0 mt-1 w-48 bg-white border border-gray-200 rounded-lg shadow-xl z-[100] max-h-60 overflow-y-auto"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                    >
                        <template x-for="item in ladas" :key="item.code">
                            <div 
                                @click="selectedLada = item.code; selectedFlag = item.flag; open = false"
                                class="flex items-center gap-3 px-4 py-3 hover:bg-gray-100 cursor-pointer text-black transition-colors border-b border-gray-50 last:border-0"
                            >
                                <span class="text-lg" x-text="item.flag"></span>
                                <span class="text-sm font-medium" x-text="item.code"></span>
                                <span class="text-xs text-gray-500" x-text="item.name"></span>
                            </div>
                        </template>
                    </div>
                </div>

                {{-- Phone Container --}}
                <div class="flex-1">
                    <input type="text" name="telefono" class="input-modern required-field" placeholder="{{ $content['placeholder_telefono'] }}">
                </div>
            </div>
        </div>

        <!-- TEXAREA FULL WIDTH -->
        <div>
            <label class="label-required">{{ $content['label_mensaje'] }} <span>*</span></label>
            <textarea name="mensaje" rows="4" class="input-modern required-field"></textarea>
        </div>

        <!-- TÉRMINOS -->
        <div class="flex items-start gap-2">
            @php
                $currentLocale = app()->getLocale();
                $localeData = \App\Models\Locale::where('code', $currentLocale)->first();
                $prefix = ($localeData && $localeData->url_prefix) ? $localeData->url_prefix : '';
                
                $slugTerminos = ($currentLocale === 'en') ? 'terms-and-conditions' : 'terminos-y-condiciones';
                $slugPrivacidad = ($currentLocale === 'en') ? 'privacy-policy' : 'aviso-de-privacidad';
                
                $urlTerminos = url($prefix . '/' . $slugTerminos);
                $urlPrivacidad = url($prefix . '/' . $slugPrivacidad);
            @endphp
            <input type="checkbox" id="terminos-{{ $uid }}" class="mt-1">
            <label for="terminos-{{ $uid }}" class="text-sm text-gray-700">
                {{ $content['label_terminos'] }} <span class="text-red-500">*</span>
            </label>
        </div>

        <!-- BOTÓN -->
        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium transition">
            {{ $content['btn_send'] }}
        </button>
    </form>
</div>

<!-- ESTILOS (SIN CAMBIOS) -->
<style>
    .input-modern {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 6px;
        background: #F5F5F5;
        outline: none;
        transition: 0.2s;
        color: black;
        font-family: 'Rubik', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Apple Color Emoji', 'Twemoji Mozilla', 'Noto Color Emoji', 'Android Emoji', sans-serif;
    }

    .input-modern:focus {
        outline: 2px solid #ccc;
    }

    /* Estilos modernos cuando el campo está bloqueado */
    .input-modern:disabled, 
    button:disabled {
        background: #EAEAEA !important;
        color: #888 !important;
        cursor: not-allowed;
        opacity: 0.7;
        filter: grayscale(0.5);
        transition: all 0.3s ease;
    }

    .label-required {
        display: block;
        width: 100%;
        font-size: 0.9rem;
        font-weight: 500;
        color: #444;
        margin-bottom: 4px;
    }

    .label-required span {
        color: red;
        font-weight: bold;
    }

    .error-field {
        outline: 2px solid red !important;
        background: #ffe5e5 !important;
    }
</style>

<!-- JS (MISMA LÓGICA, SOLO ENCAPSULADO) -->
<script>
(function() {

    const form = document.getElementById("contactForm-{{ $uid }}");
    const msg = document.getElementById("formMessage-{{ $uid }}");
    const terminos = document.getElementById("terminos-{{ $uid }}");
    const submitBtn = form.querySelector("button[type=submit]");

    function mostrarMensaje(texto, tipo) {
        msg.textContent = texto;

        msg.className = "mb-4 p-3 rounded text-white text-sm";
        msg.classList.add(tipo === "error" ? "bg-red-500" : "bg-green-600");
        msg.classList.remove("hidden");

        // Desaparecer
        setTimeout(() => msg.classList.add("hidden"), 5000);
    }

    form.addEventListener("submit", async function (e) {
        e.preventDefault();

        let valido = true;
        let campos = form.querySelectorAll(".required-field");

        campos.forEach(c => c.classList.remove("error-field"));

        campos.forEach(c => {
            if (!c.value.trim()) {
                c.classList.add("error-field");
                valido = false;
            }
        });

        if (!terminos.checked) {
            mostrarMensaje("{{ $content['msg_error_terms'] }}", "error");
            valido = false;
        }

        if (!valido) {
            mostrarMensaje("{{ $content['msg_error_fields'] }}", "error");
            return;
        }

        submitBtn.disabled = true;
        submitBtn.textContent = "{{ $content['msg_sending'] }}";

        const formData = new FormData(form);

        // Bloquear todos los campos
        const allFields = form.querySelectorAll("input, textarea, button");
        allFields.forEach(f => f.disabled = true);

        try {
            const res = await fetch("{{ route('form-contact.store') }}", {
                method: "POST",
                headers: { 
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: formData
            });

            const data = await res.json();

            if (res.ok && data.success) {
                mostrarMensaje("{{ $content['msg_success'] }}", "success");
                form.reset();
            } else {
                let errorMsg = data.message || "Hubo un error al enviar el formulario.";
                if (data.errors) {
                    errorMsg = Object.values(data.errors).flat().join(" ");
                }
                mostrarMensaje(errorMsg, "error");
            }
        } catch (error) {
            console.log(error)
            mostrarMensaje("{{ $content['msg_error_server'] }}", "error");
        } finally {
            // Re-habilitar campos
            allFields.forEach(f => f.disabled = false);
            submitBtn.disabled = false;
            submitBtn.textContent = "{{ $content['btn_send'] }}";
        }
    });

})();
</script>
@endif

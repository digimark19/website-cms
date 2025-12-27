@props(['tipo' => ''])
@php
    $uid = uniqid('form_'); // ID único para evitar conflictos
@endphp

<div class="max-w-3xl mx-auto font-[Inter]">
    <p class="text-gray-700 mb-6">
        Déjanos tu información y en breve nos pondremos en contacto contigo.
    </p>

    <!-- MENSAJE -->
    <div id="formMessage-{{ $uid }}" class="hidden mb-4 p-3 rounded text-white text-sm"></div>

    <form id="contactForm-{{ $uid }}" class="space-y-6">

        <!-- Input Hidden -->
        <input type="hidden" name="tipo" id="tipo-{{ $uid }}" value="{{ $tipo }}">

        <!-- GRID 2 COLUMNAS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Nombre -->
            <div>
                <label class="label-required">Nombre <span>*</span></label>
                <input type="text" name="nombre" class="input-modern required-field">
            </div>

            <!-- Apellido -->
            <div>
                <label class="label-required">Apellido <span>*</span></label>
                <input type="text" name="apellido" class="input-modern required-field">
            </div>

            <!-- Correo -->
            <div>
                <label class="label-required">Correo <span>*</span></label>
                <input type="email" name="correo" class="input-modern required-field">
            </div>

            <!-- Teléfono -->
            <div>
                <label class="label-required">Teléfono <span>*</span></label>
                <input type="text" name="telefono" class="input-modern required-field">
            </div>

            <!-- País -->
            <div>
                <label class="label-required">País <span>*</span></label>
                <select name="pais" class="input-modern required-field">
                    <option value="">Selecciona un país</option>
                    <option value="México">México</option>
                    <option value="Colombia">Colombia</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Chile">Chile</option>
                    <option value="Perú">Perú</option>
                </select>
            </div>

            <!-- Ciudad -->
            <div>
                <label class="label-required">Ciudad <span>*</span></label>
                <input type="text" name="ciudad" class="input-modern required-field">
            </div>
        </div>

        <!-- TEXAREA FULL WIDTH -->
        <div>
            <label class="label-required">Mensaje <span>*</span></label>
            <textarea name="mensaje" rows="4" class="input-modern required-field"></textarea>
        </div>

        <!-- TÉRMINOS -->
        <div class="flex items-start gap-2">
            <input type="checkbox" id="terminos-{{ $uid }}" class="mt-1">
            <label for="terminos-{{ $uid }}" class="text-sm text-gray-700">
                Acepto los términos y condiciones <span class="text-red-500">*</span>
            </label>
        </div>

        <!-- BOTÓN -->
        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium transition">
            Enviar
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
    }

    .input-modern:focus {
        outline: 2px solid #ccc;
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
            mostrarMensaje("Debes aceptar los términos y condiciones.", "error");
            valido = false;
        }

        if (!valido) {
            mostrarMensaje("Por favor completa todos los campos obligatorios.", "error");
            return;
        }

        submitBtn.disabled = true;
        submitBtn.textContent = "Enviando...";

        const formData = new FormData(form);

        try {
            const res = await fetch("{{ route('form-contact.store') }}", {
                method: "POST",
                headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                body: formData
            });

            const data = await res.json();

            if (data.success) {
                mostrarMensaje("Formulario enviado correctamente.", "success");
                form.reset();
            } else {
                mostrarMensaje(data.message ?? "Hubo un error al enviar el formulario.", "error");
            }
        } catch (error) {
            mostrarMensaje("Error de conexión. Intenta nuevamente.", "error");
        }

        submitBtn.disabled = false;
        submitBtn.textContent = "Enviar";
    });

})();
</script>

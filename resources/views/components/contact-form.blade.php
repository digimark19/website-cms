@props(['tipo' => ''])

<div class="max-w-3xl mx-auto font-[Inter]">
    <p class="text-gray-700 mb-6">
        Déjanos tu información y en breve nos pondremos en contacto contigo.
    </p>

    <!-- MENSAJE -->
    <div id="formMessage" class="hidden mb-4 p-3 rounded text-white text-sm"></div>

    <form id="contactForm" class="space-y-6">

        <!-- Input Hidden -->
        <input type="hidden" name="tipo" id="tipo" value="{{ $tipo }}">

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
            <input type="checkbox" id="terminos" class="mt-1">
            <label for="terminos" class="text-sm text-gray-700">
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

<!-- ESTILOS -->
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

<!-- JS -->
<script>
    const form = document.getElementById("contactForm");
    const submitBtn = form.querySelector("button[type=submit]");

    function mostrarMensaje(texto, tipo) {
        const msg = document.getElementById("formMessage");
        msg.textContent = texto;

        msg.className = "mb-4 p-3 rounded text-white text-sm";
        msg.classList.add(tipo === "error" ? "bg-red-500" : "bg-green-600");
        msg.classList.remove("hidden");

        // Desaparece en 5 segundos
        setTimeout(() => {
            msg.classList.add("hidden");
        }, 5000);
    }

    form.addEventListener("submit", async function (e) {
        e.preventDefault();

        let valido = true;
        let campos = document.querySelectorAll(".required-field");

        // LIMPIAR ERRORES
        campos.forEach(c => c.classList.remove("error-field"));

        // VALIDAR CAMPOS VACÍOS
        campos.forEach(c => {
            if (!c.value.trim()) {
                c.classList.add("error-field");
                valido = false;
            }
        });

        // VALIDAR TÉRMINOS
        const terminos = document.getElementById("terminos");
        if (!terminos.checked) {
            mostrarMensaje("Debes aceptar los términos y condiciones.", "error");
            valido = false;
        }

        if (!valido) {
            mostrarMensaje("Por favor completa todos los campos obligatorios.", "error");
            return;
        }

        // BLOQUEAR BOTÓN
        submitBtn.disabled = true;
        submitBtn.textContent = "Enviando...";

        // ENVIAR DATOS
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
            console.log(error.message)
            mostrarMensaje("Error de conexión. Intenta nuevamente.", "error");
        }

        // REACTIVAR BOTÓN
        submitBtn.disabled = false;
        submitBtn.textContent = "Enviar";
    });
</script>

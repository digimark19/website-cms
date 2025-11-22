<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div id="mapa" {{ $attributes->merge(['class' => 'rounded-2xl shadow h-[70vh] w-full']) }}></div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    var lat = {{ is_numeric($lat) && $lat != 0 ? $lat : ($siteSettings->latitude ?? 0) }};
    var lng = {{ is_numeric($lng) && $lng != 0 ? $lng : ($siteSettings->longitude ?? 0) }};
    var zoom = {{ is_numeric($zoom) && $zoom != 0 ? $zoom : ($siteSettings->zoom ?? 16) }};

    var map = L.map("mapa").setView([lat, lng], zoom);

    // ❗ Este era TU error: lo tenías comentado
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: "© OpenStreetMap contributors",
        maxZoom: zoom
    }).addTo(map);

    L.marker([lat, lng])
        .addTo(map)
        .bindPopup("Ubicación seleccionada")
        .openPopup();
});
</script>

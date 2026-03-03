/**
 * Contact page - OpenStreetMap initialization
 */
document.addEventListener('DOMContentLoaded', function () {
    var mapEl = document.getElementById('contact-map');
    if (!mapEl) return;

    // Colegiul Tehnic "Anghel Saligny" - Bd. Nicolae Grigorescu 12, Sector 3
    var lat = 44.432150;
    var lng = 26.159948;

    var map = L.map('contact-map').setView([lat, lng], 16);

    // OpenStreetMap tile layer (free, no API key)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        maxZoom: 19,
    }).addTo(map);

    // Custom marker
    var schoolIcon = L.divIcon({
        className: 'custom-marker',
        html: '<div style="background:linear-gradient(135deg,#1a3a5c,#2a5a8c);width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(0,0,0,0.3);border:3px solid #c8a84e;"><svg style="width:18px;height:18px;fill:white;" viewBox="0 0 24 24"><path d="M12 3L1 9l11 6 9-4.91V17h2V9M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z"/></svg></div>',
        iconSize: [40, 40],
        iconAnchor: [20, 40],
        popupAnchor: [0, -42],
    });

    L.marker([lat, lng], { icon: schoolIcon })
        .addTo(map)
        .bindPopup(
            '<div style="text-align:center;min-width:200px;padding:4px;">' +
            '<strong style="font-size:14px;color:#1a3a5c;">Colegiul Tehnic<br>Anghel Saligny</strong><br>' +
            '<span style="font-size:12px;color:#5a6d7e;">Bd. Nicolae Grigorescu nr. 12<br>Sector 3, București</span><br>' +
            '<a href="https://www.google.com/maps/dir/?api=1&destination=44.432150,26.159948" target="_blank" ' +
            'style="display:inline-block;margin-top:8px;padding:4px 12px;background:#1a3a5c;color:white;border-radius:4px;font-size:12px;text-decoration:none;">Indicații</a>' +
            '</div>'
        )
        .openPopup();

    // Fix map rendering in tabs/hidden containers
    setTimeout(function () { map.invalidateSize(); }, 100);
});
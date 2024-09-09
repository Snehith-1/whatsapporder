self.addEventListener('install', function(event) {
    console.log('Service worker installed.');
    event.waitUntil(
        caches.open('my-cache').then(function(cache) {
            return cache.addAll([
                '/index.html',
                '/manifest.json',
                '/service-worker.js'
            ]);
        })
    );
});

self.addEventListener('activate', function(event) {
    console.log('Service worker activated.');
});

self.addEventListener('fetch', function(event) {
    event.respondWith(
        caches.match(event.request).then(function(response) {
            return response || fetch(event.request);
        })
    );
});

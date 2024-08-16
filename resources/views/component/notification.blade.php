<div wire:poll.keep-alive></div>

<script>
    livewire.on('notify', (customer) => {
        function handlePermission(permission) {
            notificationBtn.style.display = "shown";
                Notification.permission === 'granted' ? 'none' : 'block';
        }

        if (!("Notification" in window)) {
            alert("This browser does not support desktop notification");
        } else if (Notification.permission === "granted") {
            var notification = new Notification('Student added successfully', {
                    icon: 'assets/img/logo-ct.png',
                    body: "New student "+customer.name+" is added.",
                });
                notification.onclick = function() {
                    window.open("{{ url('customer') }}");
                };
        } else if (Notification.permission !== "denied") {
            Notification.requestPermission().then((permission) => {
            if (permission === "granted") {
                var notification = new Notification('Student added successfully', {
                    icon: 'assets/img/logo-ct.png',
                    body: "New student "+customer.name+" is added.",
                });
                notification.onclick = function() {
                    window.open("{{ url('customer') }}");
                };
            }
            });
        }

    });
</script>

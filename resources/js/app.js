import './bootstrap';
import '../css/app.css';

fetch('/order', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute('content'),
    },
    body: JSON.stringify({
        name,
        phone,
        address,
        cart,
    }),
})
.then(res => res.json())
.then(data => {
    alert('Order placed successfully!');
});

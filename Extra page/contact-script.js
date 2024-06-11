document.addEventListener('DOMContentLoaded', () => {
    const contactForm = document.getElementById('contactForm');

    contactForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const subject = document.getElementById('subject').value;
        const message = document.getElementById('message').value;

        alert(`Thank you, ${name}! Your message has been sent.\n\nSubject: ${subject}\nMessage: ${message}\nWe will contact you at ${email} soon.`);
        
        contactForm.reset();
    });
});

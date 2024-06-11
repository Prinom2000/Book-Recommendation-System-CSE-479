document.addEventListener('DOMContentLoaded', () => {
    const teamMembers = document.querySelectorAll('.team-member');

    teamMembers.forEach(member => {
        member.addEventListener('click', () => {
            alert(`You clicked on ${member.querySelector('h2').innerText}`);
        });
    });
});

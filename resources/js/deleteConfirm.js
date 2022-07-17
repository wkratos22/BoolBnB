const deleteForms = document.querySelectorAll('.deleteForm');
deleteForms.forEach(form => {

    const title = form.getAttribute('data-name');

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const confirmation = confirm(`Sei sicuro di voler eliminare ${title}?`);
        if (confirmation) e.target.submit();
    });
});
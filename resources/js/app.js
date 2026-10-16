const toTop = document.createElement('button');
toTop.id = 'to-top';
toTop.type = 'button';
toTop.textContent = '↑ Наверх';
document.body.appendChild(toTop);

window.addEventListener('scroll', () => {
    toTop.classList.toggle('show', window.scrollY > 300);
});

toTop.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
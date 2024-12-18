document.querySelectorAll('.collapsible').forEach(button => {
  button.addEventListener('click', function () {
    this.classList.toggle('active');
    const content = this.nextElementSibling;
    content.style.display = content.style.display === 'block' ? 'none' : 'block';
  });
});

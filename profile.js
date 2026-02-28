function openModal(type) {
    document.getElementById('editModal').style.display = 'flex';
    document.getElementById('update_type').value = type;
    let fields = '';
    if (type === 'username') {
        fields = `
            <label for="username">New Username</label>
            <input type="text" id="username" name="username" value="${escapeHtml(window.currentUserUsername)}" required>
        `;
    } else if (type === 'email') {
        fields = `
            <label for="email">New Email</label>
            <input type="email" id="email" name="email" value="${escapeHtml(window.currentUserEmail)}" required>
        `;
    } else if (type === 'profile_image') {
        fields = `
            <label for="profile_image">Choose New Profile Image</label>
            <label class="custom-file-label" for="profile_image">Choose File</label>
            <input type="file" id="profile_image" name="profile_image" class="custom-file-input" accept="image/*" required>
            <span class="file-name" id="fileName"></span>
        `;
    }
    document.getElementById('modalFields').innerHTML = fields;
    if (type === 'profile_image') {
        var fileInput = document.getElementById('profile_image');
        var fileLabel = document.querySelector('.custom-file-label');
        var fileNameSpan = document.getElementById('fileName');
        fileLabel.onclick = function() { fileInput.click(); };
        fileInput.onchange = function() {
            fileNameSpan.textContent = fileInput.files.length ? fileInput.files[0].name : '';
        };
    }
}
function closeModal() {
    document.getElementById('editModal').style.display = 'none';
}
window.onclick = function(event) {
    var modal = document.getElementById('editModal');
    if (event.target === modal) {
        closeModal();
    }
}
function escapeHtml(str) {
    if (!str) return '';
    return str.replace(/&/g, '&amp;')
              .replace(/"/g, '&quot;')
              .replace(/'/g, '&#039;')
              .replace(/</g, '&lt;')
              .replace(/>/g, '&gt;');
}
window.currentUserUsername = document.querySelector('.profile-value') ? document.querySelectorAll('.profile-value')[0].textContent.trim() : '';
window.currentUserEmail = document.querySelector('.profile-value') ? document.querySelectorAll('.profile-value')[1].textContent.trim() : '';
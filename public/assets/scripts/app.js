const input = document.querySelector('#avatarupload');
const img = document.querySelector('#updateimg');
const removeAvatar = document.querySelector('#remove_avatar');
const removeAvatarInput = document.querySelector('#remove_avatar_input')

if (input != null || img != null) {
    input.addEventListener("change", () => {
    img.src = URL.createObjectURL(input.files[0]);
});
}
removeAvatar.addEventListener('click', () => {
    img.src = '/assets/avatars/default.jpg';
    input.value= '';
    removeAvatarInput.value = '1';
});
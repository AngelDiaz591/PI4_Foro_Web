let extraFiles = 0;
let filesArray = [];
let maxFilesShowed = 5;

const attachFile = document.querySelector('.attach-file');
const extraFiles_pElement = document.querySelector('#extra-files');
const imageInput = document.querySelector('#images');
const imagesContainer = document.querySelector('.images');

// function handleUploadedFile(file) {
//   if (maxFilesShowed === 0) {
//     extraFiles++;
//     return;
//   }
//   let reader = new FileReader();
//   reader.onload = () => {
//     img = imagepartial(reader.result);
//     imagesContainer.innerHTML += img;
//     const removeButtons = document.querySelectorAll('.remove-image');
//     removeButtons.forEach((button) => {
//       button.addEventListener('click', (e) => {
//         removeImage(e);
//       });
//     });
//   };
//   reader.readAsDataURL(file);
//   maxFilesShowed--;
// }

// function handleUploadedExtraFiles() {
//   if (extraFiles > 0) {
//     extraFiles_pElement.textContent = `+${extraFiles} files`;
//   }
// }

// function imagepartial(src) {
//   let imgPartial = `
//     <div class="image">
//       <img src="${src}">
//       <p class="remove-image">&times;</p>
//     </div>
//   `;

//   return imgPartial;
// }

// function removeImage(event) {
//   event.target.parentNode.remove();
//   maxFilesShowed++;
//   if (extraFiles > 0) {
//     extraFiles--;
//     handleUploadedFile(filesArray.shift());
//     handleUploadedExtraFiles();
//   }
//   console.log(filesArray);
// }

attachFile.addEventListener('click', () => {
  imageInput.click();
});

imageInput.addEventListener('change', () => {
  filesArray = Array.from(imageInput.files);
  extraFiles_pElement.textContent = `${filesArray.length} files`;
});

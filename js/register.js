/*
 *
 * This script is used by the register.php page
 * and it is used to validate the inputs the users put through the form
 *
 */

// register form
const form = document.getElementById('register-form');
// username input
const username = document.getElementById('username');
// username input error box for when the username is not valid
const usernameError = document.getElementById('username-exists');
// password input
const password = document.getElementById('password');
// password input error box for when the password is not valid
const passwordError = document.getElementById('password-error');
// submit button of the form
const submit = document.getElementById('submit');

let usernameDisable = false;
let passwordDisable = false;


/*
 *
 * This event listener is for the username input
 * it checks if the username is already taken
 * if it is taken then the submit button is disabled
 * it works in the same way as the email input
 * it sends a request to the php script
 *
 */
username.addEventListener('keyup', () => {
  const conn = new XMLHttpRequest();

  conn.onreadystatechange = () => {
    if (conn.readyState === 4 && conn.status === 200) {
      conn.responseText == true ? (usernameDisable = true) : (usernameDisable = false);
      usernameError.style.display = conn.responseText == true ? 'block' : 'none';
    }
    validateInputs();
  };

  conn.open('GET', './config/username.php?username=' + username.value);
  conn.send();
});

/*
 *
 * event listener for the password input field
 * this event listener listens for the keyup event
 * The keyup event is triggered when a user releases a key on the keyboard
 *
 */
password.addEventListener('keyup', (e) => {
  /*
   *
   * regular expression that checks that the password is 8 characters long,
   * has 1 uppercase letter and 1 number
   *
   */
  const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
  /*
   * if the password does not match the regex, the error message is shown
   * we check the matching with the test() method
   *
   * if the password does not match the regex, the form is also disabled
   * the form is disabled because we disable the submit button by adding
   * the disabled attribute to the submit button
   */
  if (e.target.value.length > 0) {
    if (regex.test(e.target.value)) {
      passwordError.style.display = 'none';
      passwordDisable = false;
    } else {
      passwordError.style.display = 'block';
      passwordDisable = true;
    }
  }
  validateInputs();
});

const validateInputs = () => {
  /**
   *
   * This function is used to check the inputs of the form
   * if they are not valid then the submit button is disabled
   * and the form cannot be submitted
   * if they are valid then the submit button is enabled
   * and the form can be submitted
   *
   */
  // console.log(emailDisable + ' ' + usernameDisable + ' ' + passwordDisable);
  if ( usernameDisable || passwordDisable) {
    submit.disabled = true;
  } else {
    submit.disabled = false;
  }
};


// the block of code below is used for validating the input file type, so that we cannot enter a file that is not an image, and of the allowed extensions
// it is used by the register form
const imageerrorbox = document.getElementById('register-error-box')
const photoInput = document.getElementById('profile-image');

photoInput.addEventListener('input', () => {
  // get the file extension by splitting the file name with the dot and getting the last element of the array, storing it in the const fileExtension
  const fileExtension = photoInput.value.split('.').pop();
  // check if the file extension is not one of the allowed extensions
  console.log(fileExtension)
  if(fileExtension !== 'jpg' && fileExtension !== 'png' && fileExtension !== 'jpeg') {
    // if the file is not an image, we empty the value so that the user cannot submit the form with the wrong file type
    photoInput.value = '';
    // if the file is not an image, we show the error box by changing the display property to block
    imageerrorbox.style.display = 'block';
    // we set a timeout to hide the error box after 3 seconds, we use the setTimeout method to call a function after a certain amount of time
    setTimeout(() => {
      imageerrorbox.style.display = 'none';
    }, 2500);
  }
})
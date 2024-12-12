document.addEventListener('DOMContentLoaded', function() {
    const accountTypeSelect = document.getElementById('account_type');
    const signupButton = document.getElementById('signup_button');
    const signupPrompt = document.getElementById('signup_prompt');
    const orfield = document.getElementById('orfield');
    accountTypeSelect.addEventListener('change', function() {
        if (accountTypeSelect.value === 'admin') {
            signupButton.style.display = 'none';
            signupPrompt.style.display = 'none';
            orfield.style.display = 'none';
        } else {
            signupButton.style.display = 'inline-block';
            signupPrompt.style.display = 'block';
            orfield.style.display = 'block';
        }
    });
    
    document.getElementById('login_button').addEventListener('click', function() {
        document.getElementById('login_form').style.display = 'block';
        document.getElementById('signup_form').style.display = 'none';
    });

    document.getElementById('signup_button').addEventListener('click', function() {
        document.getElementById('login_form').style.display = 'none';
        document.getElementById('signup_form').style.display = 'block';
    });
});

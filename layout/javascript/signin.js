/**
 * Captura o evento do formulário de login
 * @param {*} e 
 */
function onSubmitSignIn(e) {
    try {
        e.preventDefault();
        e.stopPropagation();

        let user = document.querySelector('.form-signin input[type="email"]').value;
        let password = document.querySelector('.form-signin input[type="password"]').value;
        doLogin(user, password);
    }
    catch(error) {
        console.log(error.message);
    }
}
/**
 * Realiza o login
 * @param {*} user 
 * @param {*} password 
 */
async function doLogin(user, password) {
    try {
        let options = {};
        const body = {
            user,
            password
        }
        let response = await axios.post('http://localhost/api.php?c=Auth&m=signIn', body, options);
        if (response.data.status === 200) {
            console.log('Login realizado com sucesso');
        }
        else {
            console.log('Falha ao realizar o login');
        }
    }
    catch(error) {
        console.log(error.message)
    }
}
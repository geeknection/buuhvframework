class BuuhVJS {
    /**
     * Executa uma ação após a página carregar completamente
     * @param {*} callback 
     */
    ready(callback) {
        window.addEventListener('load', () => {
            try {
                callback();
            }
            catch(error) {
                console.error(error.message);
            }
        });
    }
    /**
     * Alterna um submenenu como aberto ou fechado
     * @param {*} event 
     */
    toggleMenu(event) {
        try {
            let parent = event.target.parentElement;
            if (parent.classList.contains('active') === false) {
                parent.classList.add('active');
            } else {
                parent.classList.remove('active');
            }
        }
        catch(error) {
            console.error(error.message);
        }
    }
    /**
     * Escuta determinado evento de um elemento
     */
    listener(element, event, callback) {
        try {
            let item = document.querySelector(element);
            item.addEventListener(event, callback);
        }
        catch(error) {
            console.error(error.message);
        }
    }
}
const BuuhV_Js = new BuuhVJS();
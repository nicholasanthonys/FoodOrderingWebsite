import axios from 'axios';

export const getAllMenu = async() => {
    return axios
        .get('/api/menus');
}
//pasta
export const getMenuPasta = async() => {
    return axios
    .get('/api/menus/pasta');
}

//steak
export const getMenuSteak = async() => {
    return axios
    .get('/api/menus/steak');
}

//pizza
export const getMenuPizza = async() => {
    return axios
    .get('/api/menus/pizza');
}

//rice
export const getMenuRice = async() => {
    return axios
    .get('/api/menus/rice');
}

//Soup
export const getMenuSoup = async() => {
    return axios
    .get('/api/menus/soup');
}

//salad
export const getMenuSalad = async() => {
    return axios
    .get('/api/menus/salad');
}

//drinks
export const getMenuDrinks = async() => {
    return axios
    .get('/api/menus/drinks');
}






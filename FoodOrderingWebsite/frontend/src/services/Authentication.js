import axios from 'axios'

export const loginUser = async (form) => {
    return axios
        .post("/api/login", {
            email: form.email,
            password: form.password
        })
}

export const registerUser = async(form) => {
    console.log('from axios form is');
    console.log(form);
    return axios
        .post("/api/signup", {
            name : form.name,
            email : form.email,
            password : form.password,
            dob : form.dob,
            address : form.address,
            province : form.province,
            city : form.city
        })
}
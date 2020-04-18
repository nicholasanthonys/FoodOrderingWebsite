import axios from 'axios'

export const authentication = async (form) => {
    return axios
        .post("/api/login", {
            email: form.email,
            password: form.password
        })
}
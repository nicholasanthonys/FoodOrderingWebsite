import axios from 'axios';

export const getUser = async (email) => {
    return axios
        .post('/api/getUser', {
            email: email
        });
}

export const updateProfile = async (form) => {
    return axios
        .put('/api/updateProfile', {

            name: form.name,
            email: form.email,
            dob: form.DOB,
            address: form.address,
            province: form.province,
            city: form.city

        });
}

export const updatePassword = async(email,newPassword) => {
    return axios
        .put('/api/updatePassword',{
            email : email,
            newPassword : newPassword
        });
}
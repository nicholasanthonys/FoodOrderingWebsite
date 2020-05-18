import axios from 'axios'

export const getProvincies = async () => {
    return axios
        .get("/api/provinces")
}
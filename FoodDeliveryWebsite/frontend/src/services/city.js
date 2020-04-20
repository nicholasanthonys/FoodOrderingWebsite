import axios from 'axios'

export const getCitiesByProvince = async (idProvince) => {
    return axios
        .get("/api/cities/province/" + idProvince)
}
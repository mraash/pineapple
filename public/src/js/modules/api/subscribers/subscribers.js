import { apiRequests } from '../apiRequests';


export const subscribers = {
    add(email, isTermcAccept) {
        const params = {
            email,
            is_terms_accept: isTermcAccept,
        };

        return new Promise((resolve, reject) => {
            apiRequests.post('/subscribers/add', params)
                .then((response) => resolve(response))
                .catch((err) => reject(err));
        });
    },
};

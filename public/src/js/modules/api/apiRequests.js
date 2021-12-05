const  URI_PREFIX = '/user-ajax';

export const apiRequests = {
    post(uri, params) {
        const fullUri    = `${URI_PREFIX}${uri}`;
        const bodyParams = JSON.stringify(params);

        return new Promise((resolve, reject) => {
            const xhr = getStandardXmlHttpRequest(resolve, reject);

            xhr.open('POST', fullUri);
            xhr.send(bodyParams);
        });
    },
};

// All request types will have XMLHttpRequest with same settings
//   so I moved it into a separate function
function getStandardXmlHttpRequest(successCallback, failedCallback) {
    const xhr = new XMLHttpRequest();
    xhr.responseType = 'json';

    xhr.onload = () => {
        if (xhr.response?.success === true) {
            successCallback({
                httpStatus: xhr.status,
                response: xhr.response,
            });
        }
        else {
            failedCallback({
                httpStatus: xhr.status,
                response: xhr.response,
            });
        }
    };

    xhr.onerror = () => {
        failedCallback();
    };

    return xhr;
}

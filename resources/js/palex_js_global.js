
function isEmptyOrSpaces(str) {
    return str === null || str === undefined || /^ *$/.test(str);
}

function isNotEmptyOrSpaces(str) {
    return !(str === null || str === undefined || /^ *$/.test(str));
}

module.exports = {
    isEmptyOrSpaces,
    isNotEmptyOrSpaces
};
export default class Errors {
    constructor() {
        this.errors = {};
    }

    get(field) {
        // console.log("getting this field" + field)
        if (this.errors[field]) {
            return this.errors[field][0];
        }
    }

    record(errors) {
        this.errors = errors;
    }

    clear(field) {
        delete this.errors[field];
    }

    has(field) {
        return this.errors.hasOwnProperty(field);
    }

    getAllMessages() {
        let str = "";
        if (Object.keys(this.errors).length > 0 == true) {
            const keys = Object.keys(this.errors);
            for (const key of keys) {
                str = str + this.get(key);
                +", ";
            }
        }
        return str;
    }

    getArrayOfMessages() {
        let arr = [];
        if (Object.keys(this.errors).length > 0 == true) {
            const keys = Object.keys(this.errors);
            for (const key of keys) {
                // let obj = {
                //   msg: this.get(key),
                // };
                arr.push(this.get(key));
            }
        }
        return arr;
    }

    any() {
        return Object.keys(this.errors).length > 0;
    }
}

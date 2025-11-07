import { HttpAddress } from "../../HttpsUser/HttpAddress.js";
import { Toast } from "../../Toast.js";

export class Address {
    #id;
    #idUser;
    #street;
    #number;
    #city;
    #state;
    #zipCode;

    constructor(id = null, idUser = null, street = '', number = '', city = '', state = '', zipCode = '') {
        this.#id = id;
        this.#idUser = idUser;
        this.#street = street;
        this.#number = number;
        this.#city = city;
        this.#state = state;
        this.#zipCode = zipCode;

        this.http = new HttpAddress(); // Instancia o HttpAddress
        this.toast = new Toast();       // Instancia o Toast
    }

    // Getters e Setters
    getId() { return this.#id; }
    getIdUser() { return this.#idUser; }
    getStreet() { return this.#street; }
    getNumber() { return this.#number; }
    getCity() { return this.#city; }
    getState() { return this.#state; }
    getZipCode() { return this.#zipCode; }

    setId(id) { this.#id = id; }
    setIdUser(idUser) { this.#idUser = idUser; }
    setStreet(street) { this.#street = street; }
    setNumber(number) { this.#number = number; }
    setCity(city) { this.#city = city; }
    setState(state) { this.#state = state; }
    setZipCode(zip) { this.#zipCode = zip; }

    // CRUD
    async save() {
        if (!this.#street || !this.#city || !this.#zipCode) {
            this.toast.error("Preencha todos os campos obrigatórios!");
            return false;
        }

        try {
            const data = await this.http.create({
                idUser: this.#idUser,
                street: this.#street,
                number: this.#number,
                city: this.#city,
                state: this.#state,
                zipCode: this.#zipCode
            });

            if (!data?.data) {
                this.toast.error(data?.message || "Erro ao cadastrar endereço.");
                return false;
            }

            this.toast.success("Endereço cadastrado com sucesso!");
            this.#id = data.data.id;
            return true;

        } catch (error) {
            console.error("Erro ao cadastrar endereço:", error);
            this.toast.error("Erro no servidor.");
            return false;
        }
    }

    async listAllByUser(userId) {
        try {
            const data = await this.http.getAllByUser(userId);
            return data?.data || [];
        } catch (error) {
            console.error("Erro ao listar endereços:", error);
            this.toast.error("Erro ao buscar endereços.");
            return [];
        }
    }

    async findById(id) {
        try {
            const data = await this.http.getById(id);
            if (data?.data) {
                Object.assign(this, data.data);
                return true;
            }
            return false;
        } catch (error) {
            console.error("Erro ao buscar endereço:", error);
            return false;
        }
    }
}

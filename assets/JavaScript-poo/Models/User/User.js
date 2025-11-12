// classes/Users/User.js
import { HttpUser } from "../HttpsUser/HttpUser.js";
import { Toast } from "../../Toast.js";

export class User {
    #id;
    #idUserCategory;
    #name;
    #email;
    #password;
    #phone;
    #photo;
    #confirmationToken;
    #isConfirmed;

    constructor(
        id = null,
        idUserCategory = null,
        name = null,
        email = null,
        password = null,
        phone = null,
        photo = null,
        confirmationToken = null,
        isConfirmed = false
    ) {
        this.#id = id;
        this.#idUserCategory = idUserCategory;
        this.#name = name;
        this.#email = email;
        this.#password = password;
        this.#phone = phone;
        this.#photo = photo;
        this.#confirmationToken = confirmationToken;
        this.#isConfirmed = isConfirmed;

        this.http = new HttpUser();
        this.toast = new Toast();
    }

    // Getters e Setters
    getId() { return this.#id; }
    getIdUserCategory() { return this.#idUserCategory; }
    getName() { return this.#name; }
    getEmail() { return this.#email; }
    getPassword() { return this.#password; }
    getPhone() { return this.#phone; }
    getPhoto() { return this.#photo || "../storage/images/user.png"; }

    setEmail(email) { this.#email = email; }
    setPassword(password) { this.#password = password; }
    setName(name) { this.#name = name; }
    setPhone(phone) { this.#phone = phone; }

    // ===== Métodos principais =====
    async login() {
        if (!this.#email || !this.#password) {
            this.toast.error("Preencha todos os campos!");
            return false;
        }

        try {
            const data = await this.http.loginUser({
                email: this.#email,
                password: this.#password,
            });

            if (!data || data.type === "error") {
                this.toast.error(data?.message || "Erro ao fazer login");
                return false;
            }

            const userData = data.data.user;
            this.#id = userData.id;
            this.#idUserCategory = userData.idUserCategory;
            this.#name = userData.name;
            this.#phone = userData.phone;
            this.#photo = userData.photo;
            this.#isConfirmed = userData.isConfirmed;

            localStorage.setItem("userToken", data.data.token);
            localStorage.setItem("userData", JSON.stringify(userData));

            this.toast.success("Login realizado com sucesso!");
            this.#redirectByCategory();
            return true;
        } catch (error) {
            console.error("Erro ao conectar à API:", error);
            this.toast.error("Erro de conexão com o servidor");
            return false;
        }
    }

    async register(passwordConfirm) {
        if (!this.#name || !this.#email || !this.#password || !this.#phone) {
            this.toast.error("Preencha todos os campos!");
            return false;
        }

        if (this.#password !== passwordConfirm) {
            this.toast.error("As senhas não conferem!");
            return false;
        }

        try {
            const data = await this.http.createUser({
                name: this.#name,
                email: this.#email,
                password: this.#password,
                phone: this.#phone,
                passwordConfirm,
            });

            if (!data || data.type === "error") {
                this.toast.error(data?.message || "Erro ao cadastrar usuário");
                return false;
            }

            this.toast.success("Cadastro realizado com sucesso!");
            window.location.href = "/Dona-Angela-Store-/confirm-email";
            return true;
        } catch (error) {
            console.error("Erro ao registrar usuário:", error);
            this.toast.error("Erro no servidor. Tente novamente mais tarde.");
            return false;
        }
    }

    #redirectByCategory() {
        if (this.#idUserCategory === 1)
            window.location.href = "/Dona-Angela-Store-/app";
        else if (this.#idUserCategory === 3)
            window.location.href = "/Dona-Angela-Store-/admin";
        else
            window.location.href = "/Dona-Angela-Store-/seller";
    }
}
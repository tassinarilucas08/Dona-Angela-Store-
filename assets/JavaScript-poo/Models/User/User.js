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

        this.http = new HttpUser(); // Instancia o HttpUser
        this.toast = new Toast();   // Instancia o Toast
    }

    // ===== Getters e Setters =====
    getId() { return this.#id; }
    getIdUserCategory() { return this.#idUserCategory; }
    getName() { return this.#name; }
    getEmail() { return this.#email; }
    getPassword() { return this.#password; }
    getPhone() { return this.#phone; }
    getPhoto() { return this.#photo || "../storage/images/user.png"; }
    getConfirmationToken() { return this.#confirmationToken; }
    getIsConfirmed() { return this.#isConfirmed; }

    setId(id) { this.#id = id; }
    setIdUserCategory(idUserCategory) { this.#idUserCategory = idUserCategory; }
    setName(name) { this.#name = name; }
    setEmail(email) { this.#email = email; }
    setPassword(password) { this.#password = password; }
    setPhone(phone) { this.#phone = phone; }
    setPhoto(photo) { this.#photo = photo; }
    setConfirmationToken(token) { this.#confirmationToken = token; }
    setIsConfirmed(isConfirmed) { this.#isConfirmed = isConfirmed; }

    // ===== Métodos principais =====

    async login() {
        if (!this.#email || !this.#password) {
            this.toast.error("Preencha todos os campos!");
            return false;
        }

        try {
            const data = await this.http.loginUser({ email: this.#email, password: this.#password });

            if (!data || !data.data) {
                this.toast.error("Erro ao fazer login");
                return false;
            }

            // Atualiza o objeto com os dados do usuário
            const userData = data.data.user;
            this.#id = userData.id;
            this.#idUserCategory = userData.idUserCategory;
            this.#name = userData.name;
            this.#phone = userData.phone;
            this.#photo = userData.photo;
            this.#isConfirmed = userData.isConfirmed;
            this.#confirmationToken = userData.confirmationToken;

            // Salva no localStorage
            localStorage.setItem("userToken", data.data.token);
            localStorage.setItem("userData", JSON.stringify(userData));

            this.toast.success("Login realizado com sucesso!");
            this.#redirectByCategory();
            return true;

        } catch (error) {
            console.error("Erro ao conectar à API:", error);
            this.toast.error("Erro de conexão");
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
                passwordConfirm
            });

            if (!data || !data.data) {
                this.toast.error(data.message || "Erro ao cadastrar usuário.");
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

    async findByEmail(email) {
        try {
            const data = await this.http.get("/", { email });
            if (data && data.user) {
                Object.assign(this, data.user);
                return true;
            }
            return false;
        } catch (error) {
            console.error("Erro ao buscar usuário:", error);
            return false;
        }
    }

    #redirectByCategory() {
        if (this.#idUserCategory === 1) window.location.href = "/Dona-Angela-Store-/app";
        else if (this.#idUserCategory === 3) window.location.href = "/Dona-Angela-Store-/admin";
        else window.location.href = "/Dona-Angela-Store-/seller";
    }
}

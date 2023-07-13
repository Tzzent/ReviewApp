export interface Breed {
    id: number,
    name: string,
    description: string,
    age: number,
    state: string,
    likes: number,
    created_at: string,
    updated_at: string,
    user: User,
    image: Image,
}

export interface User {
    id: number,
    name: string,
    phone: string,
    address: string,
    email: string,
    email_verified_at: string,
    provider: string,
    provider_id: string,
    created_at: string,
    updated_at: string,
    image: Image,
}

export interface Image {
    id: number,
    name: string,
    public_id: string,
    secure_url: string,
    created_at: string,
    updated_at: string,
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
};

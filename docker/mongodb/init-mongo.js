db.createUser({
    user: 'admin',
    password: 'admin',
    roles: [
        {
            role: 'readWrite',
            db: 'admin',
        },
    ],
});

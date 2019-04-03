# php-vigenere

Revisiting the old cryptography cipher invented by Giovan Battista Bellaso in 1553 and misattributed to Blaise de Vigenère in the 19th century.

I made it so it could work with punctuations. There is a checkbox under the text input field to save punctuations and spaces locations and insert them back in the cipher text.
The bootstrap library is used to create a userfriendly interface.

    NOTE: This is not a secure way to encrypt any information. First of the encryption takes place on the server and not client so the data is sent "in clear" to the server (unless SSL is used) where the encryption occurs.
    Also the algorithm is cryptographically secure only if the passphrase is as long or close to the size of the data to be encrypted.
    Use this for education only about old techniques of text scrambeling and encryption.

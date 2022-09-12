use Slack;

/* INSERTING REGISTERED USERS */

INSERT INTO User VALUES (1,'scm4','a8af855d47d091f0376664fe588207f334cdad22', 0);        /* scm4     */
INSERT INTO User VALUES (2,'ddo1','a8af855d47d091f0376664fe588207f334cdad22', 0);        /* Sonne1   */
INSERT INTO User VALUES (3,'mka2','439c0f4b98b27342a1ee500601fbc94a3f4de4702b18b862faa6252a8f37d912', 0);        /* cake10   */
INSERT INTO User VALUES (4,'rho3','3f3f78e8f8b82dcbd0b1a58bcb4a4a2e1dbc6f81bfe0ce8c012f8d9c00b8f79f', 0);        /* ilovemum */

/* INSERTING DEFAULT CHANNELS */

INSERT INTO Channel VALUES (
    1,
    'Allgemein',
    'Hier können sich alle registrierte Benutzer austauschen', 
    1, 
    '2019-04-01 12:00:00',
    0,
    0
    );

INSERT INTO Channel VALUES (
    2,
    'FH Hagenberg',
    'Der offizielle Channel der FH Hagenberg', 
    1, 
    '2019-04-01 12:00:00',
    0,
    0
    );


/* INSERTING DEFAULT CHANNEL USERS */

INSERT INTO ChannelUser VALUES (
    1,
    1,      /* Allgemein     */
    1,      /* scm4          */
    '2015-01-01 00:00:00',
    0
);

INSERT INTO ChannelUser VALUES (
    2,
    1,      /* Allgemein     */
    2,      /* ddo1          */
    '2019-04-01 12:00:00',
    0
);

INSERT INTO ChannelUser VALUES (
    3,
    2,      /* FH Hagenberg  */
    2,      /* ddo1          */
    '2019-04-01 12:00:00',
    0
);

INSERT INTO ChannelUser VALUES (
    4,
    1,      /* Allgemein     */
    3,      /* mka2          */
    '2019-04-01 12:00:00',
    0
);

INSERT INTO ChannelUser VALUES (
    5,
    1,      /* Allgemein     */
    4,      /* rho3          */
    '2019-04-01 12:00:00',
    0
);

/* INSERTING DEFAULT MESSAGES */

INSERT INTO Message VALUES (
    1,          /* Id            */
    2,          /* FH Hagenberg  */
    'ddo1',      /* ddo1          */
    'Hier ist unser neuer Channel.',
    'Hallo!',
    '2019-04-01 12:00:00',
    1,
    0,
    0
);

INSERT INTO Message VALUES (
    2,
    2,          /* FH Hagenberg  */
    'rho3',      /* rho3          */
    'Hallo! Cooler Channel - danke fürs anlegen',
    'Danke',
    '2019-04-01 13:00:00',
    1,
    0,
    0
);

INSERT INTO Message VALUES (
    3,
    2,      /* FH Hagenberg  */
    'mka2',      /* mka2          */
    'Endlich Chatten <3',
    'Juhuu',
    '2019-04-01 14:00:00',
    0,
    1,
    0
);
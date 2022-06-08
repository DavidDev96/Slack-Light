use Slack;
INSERT INTO User VALUES (1,'scm4','a8af855d47d091f0376664fe588207f334cdad22', 1, 0);        /* scm4     */
INSERT INTO User VALUES (2,'ddo1','a8af855d47d091f0376664fe588207f334cdad22', 1, 0);        /* Sonne1   */
INSERT INTO User VALUES (3,'mka2','9e31e4d503cb0893c8efebb8c739cc0d40d09eac', 0, 0);        /* cake10   */
INSERT INTO User VALUES (4,'rho3','cae2f9fa51459f2ff38f92dc472c3275c8d6e393', 0, 0);        /* ilovemum */


INSERT INTO Channel VALUES (
    1,
    'Allgemein',
    'Hier können sich alle registrierte Benutzer austauschen', 
    1, 
    '2019-04-01 12:00:00',
    0,
    1
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


/* INSERTING CHANNEL USERS */

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


<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$mod_strings = array(
	'DEFAULT_CHARSET'					=> 'UTF-8',
	'LBL_DISABLED_TITLE'				=> 'Installazione SuiteCRM Disabilitata',
	'LBL_DISABLED_TITLE_2'				=> 'Installazione di SuiteCRM è stata Disabilitata',
	'LBL_DISABLED_DESCRIPTION'			=> 'Il programma di installazione è già stato eseguito una volta. Per misura di sicurezza, è stata disabilitata l´esecuzione di una seconda volta. Se sei sicuro di voler eseguirlo ancora, vai nel file config.php e individua (o aggiungi) una variabile chiamata \'installer_locked\' per impostarla in \'false\'. La riga dovrebbe essere simile a questa:',
	'LBL_DISABLED_DESCRIPTION_2'		=> 'Dopo questa modifca, cliccare il pulsante "Inizia" di seguito per iniziare l´installazione. <i>Una volta completata l´installazione, modificare il valore da \'installer_locked\' a \'true\'.</i>',
	'LBL_DISABLED_HELP_1'				=> 'Per supporto nella fase di installazione, si prega di visitare SuiteCRM',
	'LBL_DISABLED_HELP_2'				=> 'Forums di supporto',

	'LBL_REG_TITLE'						=> 'Registrazione',
	'LBL_REG_CONF_1'					=> 'Prenditi un momento per registrare SuiteCRM. Facendoci conoscere un po \' come la tua azienda prevede di utilizzare SuiteCRM, possiamo garantire di guidarti verso il prodotto giusto adatto alle esigenze aziendali.',
	'LBL_REG_CONF_2'					=> 'Il tuo nome e indirizzo email sono gli unici campi obbligatori per la registrazione. Tutti gli altri campi sono facoltativi, ma molto utili. Noi non vendiamo, condividiamo o distribuiamo le informazioni raccolte qui a terze parti.',
	'LBL_REG_CONF_3'					=> 'Grazie per esserti registrato. Cliccare sul pulsante "Fine" per accedere a SuiteCRM. La prima volta è necessario accedere al sistema utilizzando il nome utente "admin" e la password inserita nello step 2.',


	'ERR_ADMIN_PASS_BLANK'				=> 'La password di amministrazione SuiteCRM non può essere vuota.',
	'ERR_CHECKSYS_CALL_TIME'			=> 'Allow Call Time Pass Reference non è attivo (abilitarlo nel php.ini)',
	'ERR_CHECKSYS_CURL'					=> 'Non trovato: lo schedulatore di SuiteCRM verrà eseguito con funzionalità limitate.',
	'ERR_CHECKSYS_MEM_LIMIT_1'			=> 'Avviso: $memory_limit (impostare questa proprietà su ',
	'ERR_CHECKSYS_MEM_LIMIT_2'			=> 'M o più nel file php.ini)',
	'ERR_CHECKSYS_NO_SESSIONS'			=> 'Impossibile scrivere e leggere variabili di sessione. Impossibile procedere con l´installazione.',
	'ERR_CHECKSYS_NOT_VALID_DIR'		=> 'Directory non valida',
	'ERR_CHECKSYS_NOT_WRITABLE'		=> 'Attenzione: Non scrivibile',
	'ERR_CHECKSYS_PHP_INVALID_VER'		=> 'Versione PHP installata non valida: ( v',
	'ERR_CHECKSYS_PHP_UNSUPPORTED'		=> 'Versione PHP Installata Non Supportata: ( ver',
	'ERR_CHECKSYS_SAFE_MODE'			=> 'Safe Mode è attivo (disabilitarlo nel php.ini)',
	'ERR_DB_ADMIN'						=> 'Il nome utente o la password del Database non è valida (errore ',
	'ERR_DB_EXISTS_NOT'					=> 'Il Database specificato non esiste.',
	'ERR_DB_EXISTS_WITH_CONFIG'		=> 'Database already exists with config data.  To run an install with the chosen database, please re-run the install and choose: "Drop and recreate existing SuiteCRM tables?"  To upgrade, use the Upgrade Wizard in the Admin Console.  Please read the upgrade documentation located <a href="http://www.suitecrm.com" target="_new">here</a>.',
	'ERR_DB_EXISTS'						=> 'Un Database con questo nome esiste già--non è possibile crearne un altro con lo stesso nome.',
	'ERR_DB_HOSTNAME'					=> 'Il nome dell´Host non può essere vuoto.',
	'ERR_DB_INVALID'					=> 'Tipo Database selezionato Non Valido.',
	'ERR_DB_LOGIN_FAILURE_MYSQL'		=> 'Il database e/o la password di SuiteCRM non sono valide (Errore ',
	'ERR_DB_MYSQL_VERSION1'				=> 'Versione MySQL ',
	'ERR_DB_MYSQL_VERSION2'				=> ' non è supportato. Sono supportate solo versioni MySQL 4.1x e superiori.',
	'ERR_DB_NAME'						=> 'Il nome del Database non può essere vuoto.',
	'ERR_DB_NAME2'						=> "Il nome del database non può contenere '\\', '/', or '.'",
	'ERR_DB_PASSWORD'					=> 'Le passwords di SuiteCRM non corrispondono.',
	'ERR_DB_PRIV_USER'					=> 'Il nome utente dell\'amministratore del database è richiesto.',
	'ERR_DB_USER_EXISTS'				=> 'Il nome utente per SuiteCRM esiste già. Non è possibile crearne un altro con lo stesso nome.',
	'ERR_DB_USER'						=> 'Nome utente per SuiteCRM non può essere vuoto.',
	'ERR_DBCONF_VALIDATION'				=> 'Si prega di correggere i seguenti errori prima di procedere:',
	'ERR_ERROR_GENERAL'					=> 'Sono stati riscontrati i seguenti errori:',
	'ERR_LICENSE_MISSING'				=> 'Campi obbligatori non compilati',
	'ERR_LICENSE_NOT_FOUND'				=> 'Il file della licenza non trovato!',
	'ERR_LOG_DIRECTORY_NOT_EXISTS'		=> 'La log directory fornita non è una directory valida.',
	'ERR_LOG_DIRECTORY_NOT_WRITABLE'	=> 'La log directory fornita non è una directory scrivibile.',
	'ERR_LOG_DIRECTORY_REQUIRED'		=> 'La log directory è necessaria se si desidera specificare la propria.',
	'ERR_NO_DIRECT_SCRIPT'				=> 'Impossibile elaborare lo script direttamente.',
	'ERR_PASSWORD_MISMATCH'				=> 'Le passwords per SuiteCRM non corrispondono.',
	'ERR_PERFORM_CONFIG_PHP_1'			=> 'Impossibile scrivere sul file config.php',
	'ERR_PERFORM_CONFIG_PHP_2'			=> 'Puoi continuare l´installazione creando manualmente il file config.php e incollando le informazioni di configurazione di seguito nel file config.php. Tuttavia, è necessario creare il file config.php prima di passare allo step successivo.',
	'ERR_PERFORM_CONFIG_PHP_3'			=> 'Ti sei ricordato di creare il file config.php?',
	'ERR_PERFORM_CONFIG_PHP_4'			=> 'Attenzione: impossibile scrivere nel file config.php. Assicurarsi che esista.',
	'ERR_PERFORM_HTACCESS_1'			=> 'Impossibile scrivere su',
	'ERR_PERFORM_HTACCESS_2'			=> 'file.',
	'ERR_PERFORM_HTACCESS_3'			=> 'Se vuoi proteggere il tuo log file dall´essere accessibile via browser, crea un file .htaccess nelle tua log directory con la riga:',
	'ERR_PERFORM_NO_TCPIP'				=> '<b>We could not detect an internet connection.</b> When you do have a connection, please visit <a href=\\"http://www.suitecrm.com\\">http://www.suitecrm.com</a> to register with SuiteCRM. By letting us know a little bit about how your company plans to use SuiteCRM, we can ensure we are always delivering the right application for your business needs.',
	'ERR_SESSION_DIRECTORY_NOT_EXISTS'	=> 'Directory di sessione non valida.',
	'ERR_SESSION_DIRECTORY'				=> 'Directory di sessione non scrivibile.',
	'ERR_SESSION_PATH'					=> 'E´ richiesto il percorso di sessione se si desidere specificare il proprio.',
	'ERR_SI_NO_CONFIG'					=> 'Non hai incluso config_si.php nella root del documento, o non hai definito $sugar_config_si in config.php',
	'ERR_SITE_GUID'						=> 'E´ richiesta l´ID di applicazione se si desidera specificare la propria.',
	'ERR_URL_BLANK'						=> 'L\'URL non può essere vuoto.',
	'LBL_BACK'							=> 'Indietro',
	'LBL_CHECKSYS_1'					=> 'Per un corretto funzionamento dell\'installazione di SuiteCRM, assicurarsi che le verifiche di sistema elencate qui sotto siano verdi. Nel caso ce ne siano di rosse, si prega di effettuare i passi necessari per correggerle.',
	'LBL_CHECKSYS_CACHE'				=> 'Directory Cache Sub scrivibili',
	'LBL_CHECKSYS_CALL_TIME'			=> 'PHP Allow Call Time Pass Reference disattivato',
	'LBL_CHECKSYS_COMPONENT'			=> 'Componente',
	'LBL_CHECKSYS_CONFIG'				=> 'File di configurazione SuiteCRM scrivibile (config.php)',
	'LBL_CHECKSYS_CURL'					=> 'Libreria cURL',
	'LBL_CHECKSYS_CUSTOM'				=> 'Directory scrivibile personalizzata',
	'LBL_CHECKSYS_DATA'					=> 'Sottocartelle Dati scrivibili',
	'LBL_CHECKSYS_MEM_OK'				=> 'OK (Nessun Limite)',
	'LBL_CHECKSYS_MEM_UNLIMITED'		=> 'OK (Illimitato)',
	'LBL_CHECKSYS_MEM'					=> 'Limite di memoria PHP >= ',
	'LBL_CHECKSYS_MODULE'				=> 'File e sottodirectory scrivibili dei moduli',
	'LBL_CHECKSYS_NOT_AVAILABLE'		=> 'Non Disponibile',
	'LBL_CHECKSYS_OK'					=> 'OK',
	'LBL_CHECKSYS_PHP_INI'				=> '<b>Nota:</b> File di configurazione php (php. ini) si trova in:',
	'LBL_CHECKSYS_PHP_OK'				=> 'OK (ver',
	'LBL_CHECKSYS_PHPVER'				=> 'Versione PHP',
	'LBL_CHECKSYS_RECHECK'				=> 'Ri-controllare',
	'LBL_CHECKSYS_SAFE_MODE'			=> 'Modalità provvisoria PHP disattivata',
	'LBL_CHECKSYS_SESSION'				=> 'Percorso di salvataggio sessione scrivibile (',
	'LBL_CHECKSYS_STATUS'				=> 'Stato',
	'LBL_CHECKSYS_TITLE'				=> 'Accettazione Sistema di Controllo',
	'LBL_CHECKSYS_XML'					=> 'Parsing XML',
	'LBL_CLOSE'							=> 'Chiudi',
	'LBL_CONFIRM_BE_CREATED'			=> 'essere creato',
	'LBL_CONFIRM_DB_TYPE'				=> 'Tipo Database',
	'LBL_CONFIRM_DIRECTIONS'			=> 'Si prega di confermare le impostazioni sotto. Se si desidera modificare un qualsiasi valore, cliccare "Indietro" per modificare. Altrimenti cliccare "Avanti" per iniziare l´installazione.',
	'LBL_CONFIRM_LICENSE_TITLE'		=> 'Informazione Licenza',
	'LBL_CONFIRM_NOT'					=> 'non',
	'LBL_CONFIRM_TITLE'					=> 'Conferma Impostazioni',
	'LBL_CONFIRM_WILL'					=> 'sarà',
	'LBL_DBCONF_CREATE_DB'				=> 'Nuovo Database',
	'LBL_DBCONF_CREATE_USER'			=> 'Nuovo Utente',
	'LBL_DBCONF_DB_DROP_CREATE_WARN'	=> 'Attenzione: selezionando questa casella<br>tutti i dati di SuiteCRM verranno cancellati.',
	'LBL_DBCONF_DB_DROP_CREATE'		=> 'Eliminare e ricreare le tabelli esistenti di SuiteCRM?',
	'LBL_DBCONF_DB_NAME'				=> 'Nome Database',
	'LBL_DBCONF_DB_PASSWORD'			=> 'Password del database',
	'LBL_DBCONF_DB_PASSWORD2'			=> 'Immettere nuovamente la Password del Database',
	'LBL_DBCONF_DB_USER'				=> 'Nome utente del database',
	'LBL_DBCONF_DEMO_DATA'				=> 'Popolare il Database con dati di demo?',
	'LBL_DBCONF_HOST_NAME'				=> 'Nome Host',
	'LBL_DBCONF_INSTRUCTIONS'			=> 'Si prega di inserire le informazioni di configurazione del database di seguito. Se non sei sicuro di cosa compilare, suggeriamo di utilizzare i valori predefiniti.',
	'LBL_DBCONF_MB_DEMO_DATA'			=> 'Utilizzare test multi-byte nei dati di demo?',
	'LBL_DBCONF_PRIV_PASS'				=> 'Password dell´utente favorito del database.',
	'LBL_DBCONF_PRIV_USER_2'			=> 'L´account del database sopra è un utente favorito?',
	'LBL_DBCONF_PRIV_USER_DIRECTIONS'	=> 'Questo utente favorito del database deve avere le autorizzazioni necessarie per creare il database, eliminare/creare tabelle e creare un utente. Questo utente favorito del database verrà utilizzato solamente per svolgere questi compiti se necessari, durante il processo di installazione. Si può anche usare lo stesso utente del database specificato sopra se l\' utente dispone dei permessi necessari.',
	'LBL_DBCONF_PRIV_USER'				=> 'Nome Utente favorito del database',
	'LBL_DBCONF_TITLE'					=> 'Configurazione Database',
	'LBL_HELP'							=> 'Aiuto',
	'LBL_LICENSE_ACCEPTANCE'			=> 'Accetazione di Licenza',
	'LBL_LICENSE_DIRECTIONS'			=> 'Se si hanno a disposizione le informazioni sulla licenza si prega di inserirle nei seguenti campi.',
	'LBL_LICENSE_DOWNLOAD_KEY'			=> 'Scarica chiave',
	'LBL_LICENSE_EXPIRY'				=> 'Data di Scadenza',
	'LBL_LICENSE_I_ACCEPT'				=> 'Accetta',
	'LBL_LICENSE_NUM_USERS'				=> 'Numero di utenti',
	'LBL_LICENSE_OC_DIRECTIONS'		=> 'Si prega di inserire il numero di client offline acquistati.',
	'LBL_LICENSE_OC_NUM'				=> 'Numero Licenze Offline Client',
	'LBL_LICENSE_OC'					=> 'Licenze Offline Client',
	'LBL_LICENSE_PRINTABLE'				=> 'Vista stampabile',
	'LBL_LICENSE_TITLE'					=> 'Informazione Licenza',
	'LBL_LICENSE_TITLE_2'				=> 'Licenza SuiteCRM',
	'LBL_LICENSE_USERS'					=> 'Utenti con licenza',
	'LBL_MYSQL'							=> 'MySQL',
	'LBL_NEXT'							=> 'Avanti',
	'LBL_NO'							=> 'No',
	'LBL_ORACLE'						=> 'Oracle',
	'LBL_PERFORM_ADMIN_PASSWORD'		=> 'Impostazioni Password dell´amministratore',
	'LBL_PERFORM_AUDIT_TABLE'			=> 'Verica tabella /',
	'LBL_PERFORM_CONFIG_PHP'			=> 'Creazione file di configurazione di SuiteCRM',
	'LBL_PERFORM_CREATE_DB_1'			=> 'Creazione del database ',
	'LBL_PERFORM_CREATE_DB_2'			=> ' attivo ',
	'LBL_PERFORM_CREATE_DB_USER'		=> 'Creazione nome utente e password del database...',
	'LBL_PERFORM_CREATE_DEFAULT'		=> 'Creazione Dati predefiniti di SuiteCRM',
	'LBL_PERFORM_CREATE_LOCALHOST'		=> 'Creazione nome utente e password del database per il localhost...',
	'LBL_PERFORM_CREATE_RELATIONSHIPS'	=> 'Creazione Tabelle di relazione di SuiteCRM',
	'LBL_PERFORM_CREATING'				=> 'creazione /',
	'LBL_PERFORM_DEFAULT_REPORTS'		=> 'Creazione report predefiniti',
	'LBL_PERFORM_DEFAULT_SCHEDULER'	=> 'Creazione Operazioni pianificate predefinite',
	'LBL_PERFORM_DEFAULT_SETTINGS'		=> 'Inserimento impostazioni predefinite',
	'LBL_PERFORM_DEFAULT_USERS'		=> 'Creazione utenti predefiniti',
	'LBL_PERFORM_DEMO_DATA'				=> 'Compilazione delle tabelle di database con dati dimostrativi (questo può richiedere un po\' di tempo)...',
	'LBL_PERFORM_DONE'					=> 'fatto',
	'LBL_PERFORM_DROPPING'				=> 'eliminazione /',
	'LBL_PERFORM_FINISH'				=> 'Fine',
	'LBL_PERFORM_LICENSE_SETTINGS'		=> 'Aggiornamento informazioni licenza',
	'LBL_PERFORM_OUTRO_1'				=> 'Il setup di SuiteCRM ',
	'LBL_PERFORM_OUTRO_2'				=> ' è ora completo.',
	'LBL_PERFORM_OUTRO_3'				=> 'Tempo totale:',
	'LBL_PERFORM_OUTRO_4'				=> 'secondi.',
	'LBL_PERFORM_OUTRO_5'				=> 'Memoria indicativa usata:',
	'LBL_PERFORM_OUTRO_6'				=> 'bytes.',
	'LBL_PERFORM_OUTRO_7'				=> 'Il tuo sistema è ora installato e configurato per l´uso.',
	'LBL_PERFORM_REL_META'				=> 'Meta relazioni...',
	'LBL_PERFORM_SUCCESS'				=> 'Con successo!',
	'LBL_PERFORM_TABLES'				=> 'Creazione Tabelle dell´appplicazione SuiteCRM, verifica tabelle e metadati di relazione...',
	'LBL_PERFORM_TITLE'					=> 'Esegui Setup',
	'LBL_PRINT'							=> 'Stampa',
	'LBL_REQUIRED'						=> '* Campo obbligatorio',
	'LBL_SITECFG_ADMIN_PASS_2'			=> 'Re-enter SuiteCRM <em>Admin</em> Password',
	'LBL_SITECFG_ADMIN_PASS_WARN'		=> 'Attenzione: questo annullerà la password di amministratore di ogni precedente installazione.',
	'LBL_SITECFG_ADMIN_PASS'			=> 'SuiteCRM password <em>Amministratore</em>',
	'LBL_SITECFG_APP_ID'				=> 'ID Applicazione',
	'LBL_SITECFG_CUSTOM_ID_DIRECTIONS'	=> 'Override the auto-generated application ID that prevents sessions from one instance of SuiteCRM from being used on another instance.  If you have a cluster of SuiteCRM installations, they all must share the same application ID.',
	'LBL_SITECFG_CUSTOM_ID'				=> 'Fornire ID della propria Applicazione',
	'LBL_SITECFG_CUSTOM_LOG_DIRECTIONS'	=> 'Override the default directory where the SuiteCRM log resides.  No matter where the log file resides, access to it via browser will be restricted via an .htaccess redirect.',
	'LBL_SITECFG_CUSTOM_LOG'			=> 'Utilizzare una Directory di Log personalizzata',
	'LBL_SITECFG_CUSTOM_SESSION_DIRECTIONS'	=> 'Provide a secure folder for storing SuiteCRM session information to prevent session data from being vulnerable on shared servers.',
	'LBL_SITECFG_CUSTOM_SESSION'		=> 'Utilizzare una directory di sessione personalizzata per SuiteCRM',
	'LBL_SITECFG_DIRECTIONS'			=> 'Si prega di inserire i dati di configurazione qui di seguito. Se non sei sicuro sui campi da compilare, ti suggeriamo di utilizzare i valori predefiniti.',
	'LBL_SITECFG_FIX_ERRORS'			=> 'Si prega di correggere i seguenti errori prima di procedere:',
	'LBL_SITECFG_LOG_DIR'				=> 'Directory Log',
	'LBL_SITECFG_SESSION_PATH'			=> 'Percorso alla directory di sessione <br />(deve essere scrivibile)',
	'LBL_SITECFG_SITE_SECURITY'		=> 'Protezione avanzata sito',
	'LBL_SITECFG_SUGAR_UP_DIRECTIONS'	=> 'When this is enabled your system will periodically send SuiteCRM Inc. anonymous statistics about your installation that will help us understand usage patterns and improve the product.  In return for this information, administrators will receive update notices when new versions or updates are available.',
	'LBL_SITECFG_SUGAR_UP'				=> 'Abilitare gli aggiornamenti di SuiteCRM?',
	'LBL_SITECFG_SUGAR_UPDATES'		=> 'Configurazione aggiornamenti di SuiteCRM',
	'LBL_SITECFG_TITLE'					=> 'Configurazione Sito',
	'LBL_SITECFG_URL'					=> 'URL Instanza di SuiteCRM',
	'LBL_SITECFG_USE_DEFAULTS'			=> 'Utilizza Prefefiniti?',
	'LBL_START'							=> 'Inizio',
	'LBL_STEP'							=> 'Passaggio',
	'LBL_TITLE_WELCOME'					=> 'Benvenuto in SuiteCRM ',
	'LBL_WELCOME_1'						=> 'Questo programma di installazione crea le tabelle del database SuiteCRM e imposta le variabili di configurazione che avete bisogno per iniziare. L´intero processo dovrebbe durare circa dieci minuti.',
	'LBL_WELCOME_2'						=> 'Per informazioni sull\'installazione, si prega di visitare il <a href="http://suitecrm.com/index.php/forum/index" target="_blank">Forum di supporto</a> di SuiteCRM.',
	'LBL_WELCOME_CHOOSE_LANGUAGE'		=> 'Choose your language',
	'LBL_WELCOME_SETUP_WIZARD'			=> 'Installazione guidata',
	'LBL_WELCOME_TITLE_WELCOME'		=> 'Benvenuto in SuiteCRM ',
	'LBL_WELCOME_TITLE'					=> 'Installazione guidata di SuiteCRM',
	'LBL_WIZARD_TITLE'					=> 'SuiteCRM Setup Wizard: Step ',
	'LBL_YES'							=> 'Si',
);

?>

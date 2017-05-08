<?php   session_start();  ?>
<?php
      if(!isset($_SESSION['use'])) // If session is not set then redirect to Login Page
       {
           header("Location:login.php");  
       }
?>
<?php
	require __DIR__ . '/../SourceQuery/bootstrap.php';

	use xPaw\SourceQuery\SourceQuery;
	
	// Edit this ->
	define( 'SQ_SERVER_ADDR', 'baitmain.de' );
	define( 'SQ_SERVER_PORT', 27015 );
	define( 'SQ_TIMEOUT',     3 );
	define( 'SQ_ENGINE',      SourceQuery::SOURCE );
	// Edit this <-
	
	$Timer = MicroTime( true );
	
	$Query = new SourceQuery( );
	
	$Info    = Array( );
	$Rules   = Array( );
	$Players = Array( );
	
	try
	{
		$Query->Connect( SQ_SERVER_ADDR, SQ_SERVER_PORT, SQ_TIMEOUT, SQ_ENGINE );
		//$Query->SetUseOldGetChallengeMethod( true ); // Use this when players/rules retrieval fails on games like Starbound
		
		$Info    = $Query->GetInfo( );
		$Players = $Query->GetPlayers( );
		$Rules   = $Query->GetRules( );
	}
	catch( Exception $e )
	{
		$Exception = $e;
	}
	finally
	{
		$Query->Disconnect( );
	}
	
	$Timer = Number_Format( MicroTime( true ) - $Timer, 4, '.', '' );
?>
<!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <title>team baitmain | TTT-Server</title>
        
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/simple-sidebar.css">
    </head>

    <body>
        <div id="wrapper" class="toggled">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li>
                    <a href="index.php">Übersicht</a>
                </li>
                <li>
                    <a href="players.php">Spieler</a>
                </li>
                <li>
                    <a href="settings.php">Einstellungen</a>
                </li>
                <li>
                    <a href="console.php">Konsole</a><br><br>
                </li>
                <li>Angemeldet:</li>
                <?php echo "<li>" . $_SESSION['use'] . "</li>"; ?>
                <li>                    
                    <a href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
        <div class="jumbotron">
            <div class="container">
                <center>
                <h1>team baitmain | TTT-Server</h1>
                <h2>baitmain.de</h2>
                </center>
                <!-- <p class="lead">This library was created to query game server which use the Source (Steamworks) query protocol.</p>			
			    <p>
			    <a class="btn btn-large btn-primary" href="https://xpaw.me">Made by xPaw</a>
			    <a class="btn btn-large btn-primary" href="https://github.com/xPaw/PHP-Source-Query">View on GitHub</a>
			    <a class="btn btn-large btn-danger" href="https://github.com/xPaw/PHP-Source-Query/blob/master/LICENSE">LGPL v2.1</a>
		        </p> -->
            </div>
        </div>

        <div class="container">
            <br><br>
            <?php if( isset( $Exception ) ): ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <?php echo Get_Class( $Exception ); ?> at line
                    <?php echo $Exception->getLine( ); ?></div>
                <p><b><?php echo htmlspecialchars( $Exception->getMessage( ) ); ?></b>
                </p>
                <p>
                    <?php echo nl2br( $e->getTraceAsString(), false ); ?></p>
            </div>
            <?php else: ?>
            <div class="row">
                <div class="col-sm-6">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Spieler</span>
                                </th>
                                <th class="frags-column">Frags</th>
                                <th class="frags-column">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if( !empty( $Players ) ): ?>
                            <?php foreach( $Players as $Player ): ?>
                            <tr>
                                <td>
                                    <?php echo htmlspecialchars( $Player[ 'Name' ] ); ?>
                                </td>
                                <td>
                                    <?php echo $Player[ 'Frags' ]; ?>
                                </td>
                                <td>
                                    <?php echo $Player[ 'TimeF' ]; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="3">Keine Spieler</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </body>

    </html>
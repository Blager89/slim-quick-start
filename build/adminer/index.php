<?php
function adminer_object()
{
    class CustomDatabase extends Adminer
    {
        function credentials()
        {
            return [getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS')];
        }
    }
    return new CustomDatabase;
}
include "./adminer.php";
<?php

function jsonResponse($data)
{
    return response()->json([
        'status' => true,
        'data' => $data,
    ]);
}

 ?>

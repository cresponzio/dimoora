<?php
session_start();

function propertyGet($pdo, $id_immobile) {
    $sql = "SELECT * FROM immobile WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->execute(['id' => $id_immobile]);
    $immobile = $query->fetch();
    return $immobile;
}

function propertyMainPhoto($pdo, $id_immobile) {
    $sql = "SELECT * FROM foto_immobile WHERE id_immobile = :id_immobile AND tipologia = 1";
    $query = $pdo->prepare($sql);
    $query->execute(['id_immobile' => $id_immobile]);
    $mainPhoto = $query->fetch();
    return $mainPhoto;
}
<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\NiveauScolaire;

class NiveauScolaireController extends Controller
{
 public function index(){
  //  return inertia("NiveauScolaire/Index");
   return NiveauScolaire::all();
 }
}

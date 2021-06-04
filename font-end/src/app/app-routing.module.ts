import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {AuthComponent} from "./auth/auth.component";
import {KeywordComponent} from "./keyword/keyword.component";
import {RegisterComponent} from "./register/register.component";
import {MainLayoutComponent} from "./shared/layouts/main-layout.component";

const routes: Routes = [
  {
    path: '',
    component: MainLayoutComponent ,
    pathMatch: 'full',
    children: [
      { path: 'keyword', component: KeywordComponent },
    ]
  },
  { path: 'login', component: AuthComponent },
  { path: 'register', component: RegisterComponent },
  { path: '**', redirectTo: '' },
];

@NgModule({
  imports: [RouterModule.forRoot(routes, {
  })],
  exports: [RouterModule]
})
export class AppRoutingModule { }

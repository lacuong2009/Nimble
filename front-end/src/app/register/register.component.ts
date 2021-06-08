import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Router} from "@angular/router";
import {ToastrService} from "ngx-toastr";
import {FormControl, FormGroup, Validators} from "@angular/forms";
import {RegisterService} from "./register.service";

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss']
})
export class RegisterComponent implements OnInit {
  public model: any = {};
  public submitted: boolean = false;
  public form: any;

  constructor( private route: ActivatedRoute,
               private router: Router,
               private registerService: RegisterService,
               private toastr: ToastrService) {
    this.form = new FormGroup({
      name: new FormControl('', Validators.required),
      email: new FormControl('', [
        Validators.required,
        Validators.pattern("^[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,4}$")
      ]),
      password: new FormControl('', Validators.required),
      rpassword: new FormControl('', Validators.required)
    });
  }

  ngOnInit(): void {

  }

  public onSubmit() {
    if (!this.form.valid) {
      if (!this.model.rpassword) {
        this.toastr.warning('Repeat password is required', 'WARN');
      }

      if (!this.model.password) {
        this.toastr.warning('Password is required', 'WARN');
      }

      if (!this.model.email) {
        this.toastr.warning('Email is required', 'WARN');
      }

      if (this.form.get('email').invalid) {
        this.toastr.warning('Please provide a valid email address', 'WARN');
      }

      if (!this.model.name) {
        this.toastr.warning('Name is required', 'WARN');
      }

      return;
    }

    if (this.model.password.length < 6) {
      this.toastr.warning('Password validation is at least 6 character', 'WARN');
      return;
    }

    if (this.model.password !== this.model.rpassword) {
      this.toastr.warning('Repeat password is not match', 'WARN');
      return;
    }

    this.submitted = true;
    this.registerService
      .register(this.model)
      .subscribe(
        (data: any) => {
          this.toastr.success('Register successfully', 'SUCCESS');
          this.router.navigate(['/login'], {});
        },
        (error: any) => {
          if (error.error.code < 500) {
            this.toastr.error(error.error.message, 'ERROR');
          } else {
            this.toastr.error('Register failed', 'ERROR');
          }
        },
      );

  }
}

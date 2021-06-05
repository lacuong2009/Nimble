import {AfterViewInit, Component, OnInit} from "@angular/core";
import {ActivatedRoute} from "@angular/router";
import {ToastrService} from "ngx-toastr";
import {AuthService} from "../auth.service";

@Component({
  selector: 'app-keyword-details',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.scss']
})
export class ProfileComponent implements OnInit, AfterViewInit{
  public model: any = {};

  constructor(
              private route: ActivatedRoute,
              private toastr: ToastrService,
              private authService: AuthService) {
  }

  ngAfterViewInit(): void {
    this.authService.getMeDetails().subscribe(
      (response: any) => {
        this.model = response.data;
      },
      (err) => {
        this.toastr.error('Load detail data failed', 'ERROR');
      });
  }

  ngOnInit(): void {

  }
}

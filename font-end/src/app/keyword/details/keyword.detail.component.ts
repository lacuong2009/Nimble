import {AfterViewInit, Component, OnInit} from "@angular/core";
import {KeywordService} from "../keyword.service";
import {ActivatedRoute} from "@angular/router";
import {ToastrService} from "ngx-toastr";

@Component({
  selector: 'app-keyword-details',
  templateUrl: './keyword.detail.component.html',
  styleUrls: ['./keyword.detail.component.scss']
})
export class KeywordDetailComponent implements OnInit, AfterViewInit{
  private id: number = 0;
  public model: any = {};

  constructor(private keywordService: KeywordService,
              private route: ActivatedRoute,
              private toastr: ToastrService) {
  }

  ngAfterViewInit(): void {

  }

  ngOnInit(): void {
    this.route.params.subscribe(params => {
      this.id = params['id'];
      this.getDetails(this.id);
    });
  }

  public getDetails(id: number) {
    this.keywordService.detail(id).subscribe(
      (res: any) => {
        this.model = res.data;
      },
      (error: any) => {
        this.toastr.error('Load detail data failed', 'ERROR');
      }
    );
  }
}

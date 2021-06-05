import {AfterViewInit, Component, OnInit} from "@angular/core";
import {KeywordService} from "../keyword.service";

@Component({
  selector: 'app-keyword-details',
  templateUrl: './keyword.detail.component.html',
  styleUrls: ['./keyword.detail.component.scss']
})
export class KeywordDetailComponent implements OnInit, AfterViewInit{

  constructor(private keywordService: KeywordService) {
  }

  ngAfterViewInit(): void {

  }

  ngOnInit(): void {
  }

}

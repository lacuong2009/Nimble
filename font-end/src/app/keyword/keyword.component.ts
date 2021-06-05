import {AfterViewInit, Component, OnInit} from '@angular/core';
import {KeywordService} from "./keyword.service";

interface Keyword {
  id: number;
  keyword: string;
  totalAdWords: number;
  totalLinks: number;
  totalResultSeconds: number;
  totalResults: number;
}

@Component({
  selector: 'app-keyword',
  templateUrl: './keyword.component.html',
  styleUrls: ['./keyword.component.scss']
})
export class KeywordComponent implements OnInit, AfterViewInit {
  public page = 1;
  public pageSize = 10;
  public collectionSize = 0;
  public strKeyword:string = '';
  public items: Keyword[] = [];

  constructor(private keywordService: KeywordService) {
  }

  ngOnInit(): void {

  }

  ngAfterViewInit(): void {
    this.search();
  }

  public search(keyword?: string)
  {
    this.keywordService.search(keyword, this.page, this.pageSize).subscribe(
      (response: any) => {
        let data = response.data;
        this.items = data.items;
        this.collectionSize = data.total;
        console.log(data);
      },
      (error: any) => {}
    );
  }

  public pageChange(page: number)
  {
    this.page = page;
    this.search(this.strKeyword);
  }

  public isAvailable() {
    return this.items && this.items.length > 0;
  }
}
